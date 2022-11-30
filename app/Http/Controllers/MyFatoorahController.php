<?php

namespace App\Http\Controllers;

use App\Mail\UserNumber;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class MyFatoorahController extends Controller
{

    public $mfObj, $data, $user;

    public function __construct()
    {
        $this->mfObj = new PaymentMyfatoorahApiV2(
            config('myfatoorah.api_key'),
            config('myfatoorah.country_iso'),
            config('myfatoorah.test_mode')
        );
    }


    public function index()
    {
        return $this;
    }

    public function getPayLoadData($data, $user)
    {
        $callbackURL = route('website.callback', ['user' => $user, 'code' => @$data['code']]);
        return [
            'CustomerName' => $user->first_name . ' ' . $user->last_name,
            'InvoiceValue' => $data['total'],
            'DisplayCurrencyIso' => 'SAR',
            'CustomerEmail' => $user->email,
            'CallBackUrl' => $callbackURL,
            'ErrorUrl' => $callbackURL,
            'MobileCountryCode' => '+966',
            'CustomerMobile' => $user->phone,
            'Language' => 'ar',
            'CustomerReference' => $user->id,
            'SourceInfo' => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION,
            'RecurringModel' => [
                'RecurringType' => 'Monthly',
            ],
        ];
    }

    public function callback(User $user, $code = null)
    {
        try {
            $data = Subscription::calculateSubscription($code);
            $paymentData = $this->mfObj->getPaymentStatus(request('paymentId'), 'PaymentId');
            if ($paymentData->InvoiceStatus == 'Paid') {
                $userNumber = $this->afterSuccessPay($user, $data, request('paymentId'));

                return redirect()->route('website.home')->with('done_subscribed', $userNumber);
            } else if ($paymentData->InvoiceStatus == 'Failed') {
                $msg = 'Invoice is not paid due to ' . $paymentData->InvoiceError;

                return redirect()->route('website.home')->with('error_subscribed', 'Failed ->' . $msg);
            } else if ($paymentData->InvoiceStatus == 'Expired') {
                $msg = 'Invoice is expired.';

                return redirect()->route('website.home')->with('error_subscribed', 'Expired -> ' . $msg);
            }
        } catch (\Exception $e) {
            return response()->json(['IsSuccess' => 'false', 'Message' => $e->getMessage()]);
        }
    }

    private function afterSuccessPay($user, $data, $paymentId)
    {
        $user->subscriptions()->create([
            'status' => Subscription::ACTIVE,
            'amount' => $data['amount'],
            'tax_amount' => $data['tax_amount'],
            'total_amount' => $data['total'],
            'payment_method' => 'Visa',
            'end_date' => now()->addDays(30),
            'coupon_id' => $data['coupon']?->id,
            'transaction_id' => $paymentId
        ]);

        $userNumber = generateUniqueCode(User::class, 'user_number', 6);
        $user->update(['step' => 3, 'user_number' => $userNumber]);
        $user->assignRole('user');
        Mail::to($user->email)->send(new UserNumber($user));
        if ($data['coupon']) $data['coupon']->increment('used_times');

        return $userNumber;
    }
}
