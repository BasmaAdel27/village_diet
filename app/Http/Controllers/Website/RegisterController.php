<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MyFatoorahController;
use App\Http\Requests\Website\HealthyDataRequest;
use App\Http\Requests\Website\RegisterRequest;
use App\Models\Country\Country;
use App\Models\Subscriber;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        $data = Subscription::calculateSubscription($request->code);

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
        $data = Subscription::calculateSubscription($request->code);

        if ($user->currentSubscription()->exists()) {
            return failedResponse(['message' => trans('you_subscribe_already')], 422);
        }

        $paymentMethodId = 0;
        $paymentService = (new MyFatoorahController())->index();
        $redirectLink = $paymentService->mfObj->getInvoiceURL(
            $paymentService->getPayLoadData($data, $user),
            $paymentMethodId
        );

        Cache::add('invoice_id', $redirectLink['invoiceID']);

        return response(['url' => $redirectLink['invoiceURL']]);
    }

    public function reactivateSubscription(Request $request)
    {
        $data = $request->validate([
            'user_number' => 'required|string|size:6|exists:users,user_number'
        ]);

        $user = User::where('user_number', $data['user_number'])->first();

        if ($user->currentSubscription?->status == Subscription::ACTIVE) {
            return response()->json([
                'message' => trans('account_is_active'),
                'status'  => 'active',
                'title'   => trans('site.subscription_status.active')
            ]);
        } elseif (in_array($user->currentSubscription?->status, [Subscription::REQUEST_CANCEL, Subscription::FINISHED])) {
            return response()->json([
                'message' => trans('account_is_cancelled'),
                'status'  => 'finished',
                'title'   => trans('site.subscription_status.finished')
            ]);
        } else {
            return response()->json([
                'message' => route('website.payment.form', $user),
                'status'  => 'in_active',
                'title'   => trans('site.subscription_status.finished')
            ]);
        }
    }
}
