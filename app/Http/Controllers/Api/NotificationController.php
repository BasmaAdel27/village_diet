<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Notification\NotificationCollection;
use App\Http\Resources\Api\Notification\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate();
        $notifications->map->markAsRead();

        return successResponse(NotificationCollection::make($notifications));
    }

    public function show($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return successResponse(NotificationResource::make($notification));
    }
}
