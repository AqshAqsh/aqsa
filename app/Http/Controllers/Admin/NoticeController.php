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
        //$notices = Notices::where('expiry_date', '>=', Carbon::now())->latest()->get();
        $notices = Notices::latest()->get();
        return view('admin.notice.list', compact('notices'));
    }

    public function create()
    {
        return view('admin.notice.create');
    }

    public function showNotice($id)
    {
        $notice = Notices::findOrFail($id);

        $notice->expiry_date = Carbon::parse($notice->expiry_date);

        if ($notice->expiry_date->isPast()) {
            return redirect()->route('admin.notice.list')->with('error', 'This notice has expired.');
        }

        return view('notice', compact('notice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'expiry_date' => 'required|date|after:today',
        ]);

        $notice = new Notices();
        $notice->title = $request->title;
        $notice->content = $request->content;
        $notice->expiry_date = Carbon::parse($request->expiry_date);
        $notice->date = Carbon::now();  
        $notice->save();

        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NoticeNotification($notice));
        }

        return redirect()->route('admin.notice.list')->with('success', 'Notice created successfully and notified to all users!');
    }

    public function edit($id)
    {
        $notice = Notices::findOrFail($id);
        return view('admin.notice.update', compact('notice'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'expiry_date' => 'required|date|after:today',
        ]);

        $notice = Notices::findOrFail($id);
        $notice->update($request->all());

        return redirect()->route('admin.notice.list')->with('success', 'Notice updated successfully!');
    }

    public function delete($id)
    {
        Notices::destroy($id);

        return redirect()->route('admin.notice.list')->with('success', 'Notice deleted successfully');
    }
}
