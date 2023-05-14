<?php

namespace App\Http\Controllers;

use App\Http\Requests\PingRequest;
use App\Models\Ping;
use Illuminate\Http\RedirectResponse;

class PingController extends Controller
{
    
    public function index()
    {
        auth()->user()?->userActivityLogs()->create([
            'action' => "Kullanıcı Ping görev listesi görüntelendi.",
            'ip' => request()?->ip()
        ]);
        $pings = Ping::query()->latest()->paginate(10);
        return view('tasks.ping.index', compact('pings'));
    }
    
    public function store(PingRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $user?->pings()->create($request->validated());
        $user?->userActivityLogs()->create([
            'action' => "Kullanıcı yeni bir Ping görevi oluşturdu. Görev Başlığı: $request->title",
            'ip' => request()?->ip()
        ]);
        return to_route('tasks.ping.index')->with('success', 'Successful');
    }
    
    public function create()
    {
        return view('tasks.ping.create');
    }
    
    public function show(Ping $ping)
    {
        auth()->user()?->userActivityLogs()->create([
            'action' => "Kullanıcı başlığ : $ping->title olan Ping görevi görüntelendi.",
            'ip' => request()?->ip()
        ]);
        return view('tasks.ping.show', compact('ping'));
    }
    
}
