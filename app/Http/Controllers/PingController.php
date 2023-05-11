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
    
    public function getContainerData(Ping $ping)
    {
        $data = [];
        $i = 1;
        $containers = $ping->containers;
        $containers->each(function ($container) use (&$data,&$i){
            $data[] = ['name'=>"C$i",'data'=>[$container->min,$container->avg,$container->max,$container->packet_loss]];
            $i++;
        });
        
        return json_encode($data);
    }
}
