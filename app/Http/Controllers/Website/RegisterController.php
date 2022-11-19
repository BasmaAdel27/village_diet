<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\HealthyDataRequest;
use App\Http\Requests\Website\RegisterRequest;
use App\Models\Country\Country;
use App\Models\Coupon;
use App\Models\Setting;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
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
        $user = User::create(array_except($request->validated(), 'is_postal'));
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

        return redirect()->route('website.payment.form', $user)->with('success', trans('created_successfully'));
    }

    public function getPayment(Request $request, User $user)
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

        return view('website.pages.register.payment', compact(
            'user',
            'netSubscription',
            'taxAmount',
            'discount',
            'total'
        ));
    }

    public function storePayment(Request $request, User $user)
    {
        return back()->with('success', trans('created_successfully'));
    }
}
