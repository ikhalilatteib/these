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
            return back()->with('error','Böyle bir kayıtlı kullanıcı bulanamadı!');
        }
        
        return to_route('dashboard');
        
    }
    
    public function logout()
    {
        Auth::logout();
        
        return to_route('login');
    }
}
