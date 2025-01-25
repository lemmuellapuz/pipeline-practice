<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            
            'email' => [
                'required',
                Rule::unique('users'),
                Rule::email()->strict(),
            ],

            'name' => [
                'required',
                'max:255',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(6)
                    ->max(32)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }
}
