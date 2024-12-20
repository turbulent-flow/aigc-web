<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(UserRequest $request): RedirectResponse
    {
        $request->validated();

        User::create([
            'name' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email
        ]);

        return redirect('/');
    }
}
