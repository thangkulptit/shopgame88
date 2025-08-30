<?php
namespace App\Http\Controllers\admin;

use App\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class NotificationController extends Controller
{
    public function index() {
        $data['notification'] = Notification::first(); // chỉ lấy 1 bản ghi hiện tại
        return view('backend.index', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
        ]);

        $notification = Notification::first();
        if (!$notification) {
            $notification = new Notification();
        }

        $notification->title = $request->title;
        $notification->content = $request->content;
        $notification->is_active = $request->has('is_active');
        $notification->save();

        return back()->with('success', 'Cập nhật thông báo thành công!');
    }
}

