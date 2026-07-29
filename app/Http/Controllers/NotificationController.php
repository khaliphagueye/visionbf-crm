<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function unread(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'count' => $user->unreadNotifications->count(),
            'notifications' => $user->unreadNotifications->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'message' => $notification->data['message'] ?? '',
                    'raison_sociale' => $notification->data['raison_sociale'] ?? '',
                    'url' => $notification->data['url'] ?? '#',
                    'time' => $notification->created_at->diffForHumans(),
                ];
            })
        ]);
    }
    public function markAsRead(Request $request, $id)
{
    // On cherche la notification par son ID et on la marque comme lue
    $notification = $request->user()->unreadNotifications()->where('id', $id)->first();

    if ($notification) {
        $notification->markAsRead();
    }

    return response()->json(['success' => true]);
}
}