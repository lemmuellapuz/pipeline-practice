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
                'unique',
                Rule::email()->strict()->preventSpoofing(),
            ],

            'name' => [
                'required',
                'max:255',
            ],

            'password' => [
                Password::min(6)
                ->max(32)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()
                ->required(),
                'confirmed'
            ],
        ];
    }
}
