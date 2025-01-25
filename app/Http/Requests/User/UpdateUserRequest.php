<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
                Rule::unique('users')->ignore($this->user()->id, 'id'),
                Rule::email()->strict()->preventSpoofing(),
            ],

            'name' => [
                'required',
                'max:255',
            ],
        ];
    }
}
