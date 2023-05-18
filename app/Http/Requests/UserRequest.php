<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
        if ($this->route('user')) {
            $userId = $this->route('user')->id;
        } else {
            $userId = auth()->id();
        }
        
        if ($this->isMethod('PUT')) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|string|email|max:255|unique:users,email,' . $userId;
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }
        
        return $rules;
    }
    
    public function authorize()
    {
        return true;
    }
}
