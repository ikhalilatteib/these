<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    
    public function loginIn(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'remember' => 'boolean'
        ]);
        
        $remember = $data['remember'] ?? false;
        unset($data['remember']);
        if (!Auth::attempt($data, $remember)) {
          
          return  response([
                'message' => 'Böyle bir kayıtlı kullanıcı bulanamadı'
            ], 422);
           
        }
        auth()->user()?->userActivityLogs()->create([
            'action' => "Kullanıcı sisteme giriş yaptı.",
            'ip' => request()?->ip()
        ]);
        return response()->json(['success' => true]);
        
    }
    
    public function logout()
    {
        auth()->user()?->userActivityLogs()->create([
            'action' => "Kullanıcı sistemden çıkış yaptı",
            'ip' => request()?->ip()
        ]);
        Auth::logout();
        
        return to_route('login');
    }
}
