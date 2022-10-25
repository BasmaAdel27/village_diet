<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDatatable;
use App\DataTables\Admin\UserChatDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Mail\UserNumber;
use App\Models\Chat\AdminMessage;
use App\Models\Country\Country;
use App\Models\HealthyInformation;
use App\Models\State\State;
use App\Models\Subscriber;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use MattDaneshvar\Survey\Models\Entry;
use MattDaneshvar\Survey\Models\Survey;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.users.index')->only(['index']);
        $this->middleware('permission:admin.users.statistics')->only(['statistics']);
        $this->middleware('permission:admin.users.store')->only(['store']);
        $this->middleware('permission:admin.users.update')->only(['update']);
        $this->middleware('permission:admin.users.destroy')->only(['destroy']);
    }

    public function index(UserDatatable $userDatatable)
    {
        return $userDatatable->render('admin.users.index');
    }

    public function create()
    {
        $countries = Country::join('country_translations', 'countries.id', 'country_translations.country_id')
            ->where('locale', app()->getLocale())
            ->select('name', 'countries.id')
            ->pluck('name', 'id');

        $states = State::join('state_translations', 'states.id', 'state_translations.state_id')
            ->where('locale', app()->getLocale())
            ->select('name', 'states.id')
            ->pluck('name', 'id');
        $subscriptionStatus = Subscription::STATUSES;

        return view('admin.users.create', compact('countries', 'states', 'subscriptionStatus'));
    }


    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        $userNumber = generateUniqueCode(User::class, 'user_number', 6);
        $user = User::make()->fill($request->validated() + ['user_number' => $userNumber]);
        $user->assignRole('user');
        $user->save();

        Mail::to($user->email)->send(new UserNumber($user));

        if ($request->subscribe) {
            Subscriber::create([
                'email' => $user->email
            ]);
        }
        DB::commit();

        return redirect()->route('admin.users.index')->with('success', trans('created_successfully'));
    }

    public function edit(User $user)
    {
        $countries = Country::join('country_translations', 'countries.id', 'country_translations.country_id')
            ->where('locale', app()->getLocale())
            ->select('name', 'countries.id')
            ->pluck('name', 'id');

        $states = State::join('state_translations', 'states.id', 'state_translations.state_id')
            ->where('locale', app()->getLocale())
            ->select('name', 'states.id')
            ->pluck('name', 'id');
        $subscriptionStatus = Subscription::STATUSES;

        return view('admin.users.edit', compact('countries', 'states', 'subscriptionStatus', 'user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $userNumber = generateUniqueCode(User::class, 'user_number', 6);
        $user->fill($request->validated() + ['user_number' => $userNumber]);
        $user->save();

        if ($request->subscribe && !in_array($user->email, Subscriber::pluck('email')->all())) {
            Subscriber::create([
                'email' => $user->email
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', trans('updated_successfully'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', trans('deleted_successfully'));
    }

    public function statistics(User $user)
    {
        $data = HealthyInformation::select(['weight', 'sleep_hours', 'walk_duration', 'daily_cup_count', 'day_translations.title'])
            ->join('day_translations', 'healthy_information.day_id', 'day_translations.day_id')
            ->where('locale', app()->getLocale())
            ->where('user_id', $user->id)
            ->where('healthy_information.created_at', '>=', today()->startOfMonth())
            ->where('healthy_information.created_at', '<=', today()->endOfMonth())
            ->get();
        $cahrts['weights'] = $data->pluck('weight')->toArray();
        $cahrts['daily_cup_count'] = $data->pluck('daily_cup_count')->toArray();
        $cahrts['walk_duration'] = $data->pluck('walk_duration')->toArray();
        $cahrts['sleepHours'] = $data->pluck('sleep_hours')->toArray();
        $cahrts['days'] = $data->pluck('title')->toArray();

        return view('admin.users.statistics', compact('cahrts'));
    }

    public function getFormData()
    {
        $users = User::whereHas('roles', fn ($q) => $q->where('name', 'user'))
            ->doesntHave('entry')->pluck('first_name', 'id');
        $survey = Survey::where(
            'name',
            (app()->getLocale() == 'ar') ?
                'النموذج الصحي' :
                'Health Model'
        )
            ->first();

        return view('admin.users.form_data', compact('survey', 'users'));
    }

    public function postFormData(Request $request, Survey $survey)
    {
        $answers = $this->validate($request, $survey->rules + [
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::find($request->user_id);
        (new Entry())->for($survey)->by($user)->fromArray(collect($answers)->except('user_id')->all())->push();

        return redirect()->route('admin.users.index')->with('success', trans('created_successfully'));
    }

    public function messages(UserChatDatatable $userChatDatatable)
    {
        return $userChatDatatable->render('admin.users.chat.index');
    }

    public function chat($userId)
    {
        $adminId = auth()->id();

        $messages = AdminMessage::with('sender', 'receiver')
            ->where(function ($q) use ($userId, $adminId) {
                $q->where(fn ($q) => $q->where('sender_id', $userId)->where('receiver_id', $adminId))
                    ->orWhere(fn ($q) => $q->where('sender_id', $adminId)->where('receiver_id', $userId));
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.chat.show', compact('messages'));
    }
}
