<?php

namespace App\Http\Controllers\Trainer;

use App\DataTables\Trainer\UserDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SendMessageRequest;
use App\Models\Chat\TrainerMessage;
use App\Models\HealthyInformation;
use App\Models\Society\Society;
use App\Models\Trainer;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:trainer.users.index')->only(['index']);
        $this->middleware('permission:trainer.users.statistics')->only(['statistics']);
    }

    public function index(UserDatatable $userDatatable)
    {
        return $userDatatable->render('trainer.users.index');
    }

    public function show(User $user)
    {
        return view('trainer.users.show', compact('user'));
    }

    public function statistics(User $user)
    {
        $data = HealthyInformation::select(['weight', 'sleep_hours', 'daily_cup_count', 'day_translations.title'])
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

        return view('trainer.users.statistics', compact('cahrts'));
    }

    public function messages($userId)
    {
        $trainerId = auth()->id();
        $user = User::find($userId);
        $societies = Society::where('trainer_id', $trainerId)->get();
        foreach ($societies as $society) {
            if ($user->society_id == $society->id) {
                $messages = TrainerMessage::with('sender', 'receiver')
                      ->where(function ($q) use ($userId, $trainerId) {
                          $q->where(fn($q) => $q->where('sender_id', $userId)->where('receiver_id', $trainerId))
                                ->orWhere(fn($q) => $q->where('sender_id', $trainerId)->where('receiver_id', $userId));
                      })
                      ->oldest('id')
                      ->get();
                foreach ($messages as $message)
                {
                    if (\auth()->id()==$message->receiver_id)
                    {
                        $message->read_at = now();
                        $message->save();
                    }
                }
                return view('trainer.users.chat', compact('messages', 'userId','user'));
            }
        }
        return redirect()->back();
    }


    public function sendMessage(SendMessageRequest $request, $userId)
    {
        TrainerMessage::create([
              'message' => $request->message,
              'sender_id' => auth()->id(),
              'type' => 'TEXT',
              'receiver_id' => $userId,
        ]);

        return redirect()->back();
    }
    public function audioMessage(SendMessageRequest $request){
        $path = $request->file('message')->storePublicly('chats/media', "public");
        $message=TrainerMessage::create([
              'message'=>"/storage/" . $path,
              'sender_id' => auth()->id(),
              'type' => 'AUDIO',
              'receiver_id' => $request->receiver,
        ]);
        return response()->json($message);
    }

}
