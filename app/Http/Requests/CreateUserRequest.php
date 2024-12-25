<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'unique:users,name|required',
            'password' => 'confirmed|required',
            'email' => 'email|required'
        ];
    }
}
