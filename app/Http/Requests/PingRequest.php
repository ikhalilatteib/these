<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'container' => 'required|numeric|min:1|lte:10',
            'ip' => 'required|string|regex:/^(?:\d{1,3}\.){3}\d{1,3}(?:,\s*(?:\d{1,3}\.){3}\d{1,3})*$/',
            'max_ping'=>'required|min:1|lte:10'
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}
