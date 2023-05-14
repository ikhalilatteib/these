<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        auth()->user()?->userActivityLogs()->create([
            'action' => "Kullanıcı Kullanıcılar listesi görüntelendi.",
            'ip' => request()?->ip()
        ]);
        $users = User::query()->latest()->paginate(10);
        return view('users.index', compact('users'));
    }
    
    public function store(UserRequest $request)
    {
        
        auth()->user()?->userActivityLogs()->create([
            'action' => "Kullanıcı adı olan : $request->name yeni bir kullanıcı oluşturdu.",
            'ip' => request()?->ip()
        ]);
        
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        
        User::create($data);
        
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    
    public function create()
    {
        return view('users.create');
    }
    
    public function show(User $user)
    {
        auth()->user()?->userActivityLogs()->create([
            'action' => "Kullanıcı adı olan : $user->name profilini görüntelendi.",
            'ip' => request()?->ip()
        ]);
        
        $logs = $user->userActivityLogs()->latest()->paginate(10);
        
        return view('users.show', compact('user', 'logs'));
    }
    
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $user->password;
        }
        
        $user->update($data);
        
        return to_route('users.index')->with('warning', 'User updated successfully.');
    }
    
    public function destroy(User $user)
    {
        auth()->user()?->userActivityLogs()->create([
            'action' => "Kullanıcı adı olan : $user->name hesabini sildi.",
            'ip' => request()?->ip()
        ]);
        $user->delete();
        return to_route('users.index')->with('danger', 'User updated successfully.');
    }
    
    public function account()
    {
        $user = auth()->user();
        $user?->userActivityLogs()->create([
            'action' => "Kullanıcı kendi profilini görüntelendi.",
            'ip' => request()?->ip()
        ]);
        
        $logs = $user?->userActivityLogs()->latest()->paginate(10);
        
        return view('users.account',compact('logs'));
    }
    
    public function updateAccount(UserRequest $request): RedirectResponse
    {
        Auth::user()?->update($request->validated());
        
        return back()->with('updated','Successful updated');
    }
    
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password'=>'required|current_password',
            'password'=> 'required|min:8'
        ]);
        
        Auth::user()?->update(['password' => Hash::make($request->password)]);
        
        return back()->with('changed','Password changed successful');
    }
}
