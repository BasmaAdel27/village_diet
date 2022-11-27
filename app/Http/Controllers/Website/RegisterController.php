<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\HealthyDataRequest;
use App\Http\Requests\Website\RegisterRequest;
use App\Mail\UserNumber;
use App\Models\Country\Country;
use App\Models\Coupon;
use App\Models\Setting;
use App\Models\Subscriber;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use MattDaneshvar\Survey\Models\Entry;
use MattDaneshvar\Survey\Models\Survey;

class RegisterController extends Controller
{
    public function getRegister()
    {
        $countries = Country::listsTranslations('name')->pluck('name', 'id');

        return view('website.pages.register.register', compact('countries'));
    }

    public function storeRegister(RegisterRequest $request)
    {
        $user = User::firstWhere(['email' => $request->email, 'phone' => $request->phone]);
        if ($user) {
            if ($user->step == 1) {
                return redirect()->route('website.healthy.form', $user)->with('success', trans('complete_your_data'));
            }
            if ($user->step == 2) {
                return redirect()->route('website.payment.form', $user)->with('success', trans('complete_your_data'));
            }
        }
        $user = User::create(array_except($request->validated(), 'is_postal') + ['step' => 1]);
        if ($request->is_postal) Subscriber::create(['email' => $request->email]);

        return redirect()->route('website.healthy.form', $user)->with('success', trans('created_successfully'));
    }

    public function getHealthyForm(User $user)
    {
        $survey = Survey::where(
            'name',
            (app()->getLocale() == 'ar') ?
                'النموذج الصحي' :
                'Health Model'
        )
            ->first();


        return view('website.pages.register.form', compact('user', 'survey'));
    }

    public function storeHealthyForm(HealthyDataRequest $request, User $user, Survey $survey)
    {
        $answers = $this->validate($request, $survey->rules);
        (new Entry())->for($survey)->by($user)->fromArray(collect($answers)->all())->push();
        $user->update(['step' => 2]);

        return redirect()->route('website.payment.form', $user)->with('success', trans('created_successfully'));
    }

    public function getPayment(Request $request, User $user)
    {
        $data = $this->calculateSubscription($request);

        return view('website.pages.register.payment', [
            'user' => $user,
            'netSubscription' => $data['amount'],
            'taxAmount' => $data['tax_amount'],
            'discount' => $data['discount'],
            'total' => $data['total']
        ]);
    }

    public function storePayment(Request $request, User $user)
    {
        $data = $this->calculateSubscription($request);
        if ($request->renew) {
        } else {
        }

        if ($user->currentSubscription()->exists()) {
            return failedResponse(['message' => trans('you_subscribe_already')], 422);
        }

        $userNumber = $this->afterSuccessPay($user, $data);

        return successResponse(['user_number' => $userNumber]);
    }

    private function calculateSubscription($request)
    {
        $discount = 0;
        $setting = Setting::first();
        $netSubscription = $setting->net_subscription;
        $taxAmount = $setting->tax_amount;
        $coupon = Coupon::whereColumn('used_times', '<', 'max_used')
            ->where('end_date', '>=', now()->endOfDay())
            ->where('code', $request->code)->first();

        $subTotal = $netSubscription + $taxAmount;

        if ($coupon) {
            $discount = ($coupon->coupon_type == 'fixed') ? $coupon->amount : ($subTotal * $coupon->percent) / 100;
        }
        $total = $subTotal - $discount;

        return [
            'amount' => $netSubscription,
            'tax_amount' => $taxAmount,
            'coupon' => $coupon,
            'total' => $total,
            'discount' => $discount
        ];
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
        Mail::to($user->email)->send(new UserNumber($user));
        if ($data['coupon']) $data['coupon']->increment('used_times');

        return $userNumber;
    }
}
