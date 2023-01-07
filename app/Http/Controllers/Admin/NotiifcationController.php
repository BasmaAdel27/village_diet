<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\NotificationDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NotificationRequest;
use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Str;

class NotiifcationController extends Controller
{
    public function index(NotificationDatatable $notificationDatatable)
    {
        return $notificationDatatable->render('admin.notifications.index');
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(NotificationRequest $notificationRequest, DatabaseNotification $notification)
    {
        $data = $notificationRequest->validated();
        if ($data['type'] == 'users') {
            $users = User::whereHas('roles', fn($q) => $q->where('name', 'user'))->get();
        } elseif ($data['type'] == 'trainers') {
            $users = User::whereHas('roles', fn($q) => $q->where('name', 'trainer'))->get();
        } else {
            $users = User::all();
        }
        $title = 'Village Diet';
        $content = $data['data']['content'];
        $message = [
              'title' => $data['data']['title'],
              'title_ar' => $data['data']['title'],
              'body' => $data['data']['content'],
              'body_ar' => $data['data']['content'],
              'type' => 'adminDashboard',
        ];

        foreach ($users as $user) {
            DatabaseNotification::create($data + [
                        'notifiable_id' => $user->id,
                        'notifiable_type' => 'App\Models\User',
                        'id' => Str::uuid(),
                        'message_ar' => $data['data']['content'],
                        'message_en' => $data['data']['content'],
                  ]);

            if ($user->firebase_token) {
                send_notification([$user->firebase_token], $content, $title, $message);
            }
        }

        return redirect()->route('admin.notifications.index')->with('success', trans('created_successfully'));
    }

    public function destroy(DatabaseNotification $notification)
    {
        $notification->delete();

        return redirect()->route('admin.notifications.index')->with('success', trans('deleted_successfully'));
    }
}
