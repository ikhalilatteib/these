<?php

namespace App\Http\Controllers;

use App\Http\Requests\PingRequest;
use App\Models\Ping;
use Illuminate\Http\RedirectResponse;

class PingController extends Controller
{
    
    public function index()
    {
        $pings = Ping::query()->paginate(10);
        return view('tasks.ping.index', compact('pings'));
    }
    
    public function store(PingRequest $request): RedirectResponse
    {
        auth()->user()?->pings()->create($request->validated());
        return to_route('tasks.ping.index')->with('success', 'Successful');
    }
    
    public function create()
    {
        return view('tasks.ping.create');
    }
    
    public function show(Ping $ping)
    {
        return view('tasks.ping.show', compact('ping'));
    }
}
