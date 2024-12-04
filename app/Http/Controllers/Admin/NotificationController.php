<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $data = User::latest()->get();
        return view('admin.notifications.index', compact('data'));
    }

    public function store(Request $request)
    {
        // Memicu event untuk mengirim notifikasi
        event(new NotificationEvent(
            $request->users,
            $request->title,
            $request->message,
            'https://google.com'
        ));

        return redirect()->route('admin.notify.index')->with('success', 'Berhasil Mengirim');
    }
}
