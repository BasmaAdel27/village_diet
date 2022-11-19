<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\HealthyDataRequest;
use App\Http\Requests\Website\RegisterRequest;
use App\Models\Country\Country;
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

        return redirect()->route('website.payment.form')->with('success', trans('created_successfully'));
    }

    public function getPayment()
    {
        return view('website.pages.register.payment');
    }

    public function storePayment()
    {
    }
}
