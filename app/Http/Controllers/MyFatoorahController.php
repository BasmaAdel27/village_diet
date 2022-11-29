<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function getPayLoadData($data, $renew = false, $user)
    {
        $callbackURL = route('website.callback', ['user' => $user, 'code' => $data['code']]);
        $data = [
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
              'SourceInfo' => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
        ];

        if ($renew) {
            $data += [
                  'RecurringModel' => [
                        'RecurringType' => 'Monthly',
                  ],
            ];
        }

        return $data;
    }

    public function callback(User $user, $code)
    {
        try {
            $data = $this->mfObj->getPaymentStatus(request('paymentId'), 'PaymentId');
            if ($data->InvoiceStatus == 'Paid') {
                $userNumber = $this->afterSuccessPay($user, $code);

                return redirect()->to('website.home')->with('message', $userNumber);
            } else if ($data->InvoiceStatus == 'Failed') {
                $msg = 'Invoice is not paid due to ' . $data->InvoiceError;

                return redirect()->to('website.home')->with('message', 'Failed' . $msg);
            } else if ($data->InvoiceStatus == 'Expired') {
                $msg = 'Invoice is expired.';

                return redirect()->to('website.home')->with('message', 'Expired' . $msg);
            }
        } catch (\Exception $e) {
            return response()->json(['IsSuccess' => 'false', 'Message' => $e->getMessage()]);
        }
    }

    private function afterSuccessPay($user, $data)
    {
        $user->subscriptions()->create([
              'status' => Subscription::ACTIVE,
              'amount' => $data['amount'],
              'tax_amount' => $data['tax_amount'],
              'total_amount' => $data['total'],
              'payment_method' => 'Visa',
              'end_date' => now()->addDays(30),
              'coupon_id' => $data['coupon']?->id,
        ]);

        $userNumber = generateUniqueCode(User::class, 'user_number', 6);
        $user->update(['step' => 3, 'user_number' => $userNumber]);
        $user->assignRole('user');
        // Mail::to($user->email)->send(new UserNumber($user));
        if ($data['coupon']) $data['coupon']->increment('used_times');

        return $userNumber;
    }

}
