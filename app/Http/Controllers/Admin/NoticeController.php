<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notices;
use Illuminate\Http\Request;
use PHPUnit\Framework\Error\Notice;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Notifications\NoticeNotification;
use Symfony\Contracts\Service\Attribute\Required;


class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notices::latest()->get();
        return view('admin.notice.list', compact('notices'));
    }
    public function create()
    {
        return view('admin.notice.create');
    }
    public function showNotice($id)
    {
        $notice = Notices::find($id);
        // Ensure expiry_date is a Carbon instance
        $notice->expiry_date = Carbon::parse($notice->expiry_date);
        return view('notice', compact('notice'));
    }



    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'expiry_date' => 'required|date',
        ]);

        // Create a new notice
        $notice = new Notices();
        $notice->title = $request->title;
        $notice->content = $request->content;
        $notice->expiry_date = $request->expiry_date;
        $notice->date = Carbon::now();  // Set the current date as the notice date
        $notice->save();

        // Optionally, send a notification to users (separate logic, not tied to notice)
        // if you want to notify users about the new notice, you can dispatch it separately

        // Redirect after success
        return redirect()->route('admin.notice.list')->with('success', 'Notice created successfully!');
    }


    public function edit($id)
    {
        $notices = Notices::findOrFail($id);
        return view('admin.notice.update', compact('notices'));
    }
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => 'Required',
            'date' => 'Required',
            'content' => 'Required',
        ]);
        Notices::findOrFail($id)->update($validate);

        return redirect()->route('admin.notice.list')->with('success', 'Notice update successfully');
    }
    public function delete(Request $request, $id)
    {
        Notices::destroy($id);

        return redirect()->route('admin.notice.list')->with('success', 'Notice deleted successfully');
    }
}
