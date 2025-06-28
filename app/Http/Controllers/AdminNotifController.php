<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Notifications\DatabaseNotification;
class AdminNotifController extends Controller
{
    public function baca($id)
{
    $notification = auth()->user()->notifications()->findOrFail($id);

    // Tandai sebagai dibaca
    $notification->markAsRead();

    // Redirect ke link yang tersimpan di notifikasi
    return redirect($notification->data['link']);
}
}
