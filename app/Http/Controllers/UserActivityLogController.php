<?php

namespace App\Http\Controllers;

use App\Models\UserActivityLog;

class UserActivityLogController extends Controller
{
    public function __invoke()
    {
        auth()->user()?->userActivityLogs()->create([
            'action' => "Kullanıcı loglari inceledi",
            'ip' => request()?->ip()
        ]);
        $logs = UserActivityLog::query()->latest()->paginate(10);
        return view('logs.index',compact('logs'));
    }
}
