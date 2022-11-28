<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDatatable;
use App\Notifications\SendAdminNewMessage;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SendMessageRequest;
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
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use MattDaneshvar\Survey\Models\Entry;
use MattDaneshvar\Survey\Models\Survey;
use Illuminate\Support\Str;

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

      Subscription::create([
            'status' => Subscription::ACTIVE,
            'status_ar' => trans(Subscription::ACTIVE),
            'amount' => 0,
            'total_amount' => 0,
            'payment_method'=>'cash',
            'user_id'=>$user->id,
            'end_date'=> now()->addDays(30),
        ]);



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

    public function messages($userId)
    {
        $adminId = auth()->id();
        $user = User::find($userId);

        $messages = AdminMessage::with('sender', 'receiver')
            ->where(function ($q) use ($userId, $adminId) {
                $q->where(fn ($q) => $q->where('sender_id', $userId)->where('receiver_id', $adminId))
                    ->orWhere(fn ($q) => $q->where('sender_id', $adminId)->where('receiver_id', $userId));
            })
            ->oldest('id')
            ->get();
        foreach ($messages as $message) {
            if (\auth()->id() == $message->receiver_id) {
                $message->read_at = now();
                $message->save();
            }
        }

        return view('admin.users.chat', compact('messages', 'userId', 'user'));
    }

    public function sendMessage(SendMessageRequest $request, $userId)
    {
        $adminMessage = AdminMessage::create([
            'message' => $request->message,
            'sender_id' => auth()->id(),
            'type' => 'TEXT',
            'receiver_id' => $userId,
        ]);

        $receiver = User::find($userId);

        // send notification to delivery
        $title = 'Village Diet';
        $content = trans('u_receive_new_message');
        $message = [
              'data' => $adminMessage
        ];
//        $this->saveNotification($storeMessageRequest->receiver_id);
        Notification::send($receiver, new SendAdminNewMessage($adminMessage));
        if ($receiver->firebase_token) {
            send_notification($receiver->firebase_token, $content, $title, $message);
        }

//        $this->saveNotification($userId);

        return redirect()->back();
    }

    public function audioSave(SendMessageRequest $request)
    {
        $path = $request->file('message')->storePublicly('chats/media', "public");
        $adminMessage = AdminMessage::create([
            'message' => "/storage/" . $path,
            'sender_id' => auth()->id(),
            'type' => 'AUDIO',
            'receiver_id' => $request->receiver,
        ]);
        $receiver = User::find($request->receiver);

        // send notification to delivery
        $title = 'Village Diet';
        $content = trans('u_receive_new_message');
        $message = [
              'data' => $adminMessage
        ];
//        $this->saveNotification($storeMessageRequest->receiver_id);
        Notification::send($receiver, new SendAdminNewMessage($adminMessage));
        if ($receiver->firebase_token) {
            send_notification($receiver->firebase_token, $content, $title, $message);
        }
        return response()->json($adminMessage);
    }

    public function saveNotification($id)
    {
        $data['id'] = Str::uuid();
        $data['type'] = 'chat';
        $data['notifiable_id'] = $id;
        $data['notifiable_type'] = User::class;
        $data['data']['type'] = 'chat';
        $data['data']['title'] = trans('mobile.notifications.content.new_message', locale: 'en');
        $data['data']['title_ar'] = trans('mobile.notifications.content.new_message', locale: 'ar');
        $data['data']['body'] = trans('u_receive_new_message', locale: 'en');
        $data['data']['body_ar'] = trans('u_receive_new_message', locale: 'ar');

        DatabaseNotification::create($data);

        $user = User::find($id);
        send_notification([$user->firebase_token], $data['data']);
    }
}
