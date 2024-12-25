<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Hamcrest\Core\HasToString;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showForm(): View
    {
        return view('login');
    }

    public function authenticate(UserLoginRequest $request): RedirectResponse
    {
        $request->validated();

        $credentials = [
            'name' => $request['username'],
            'password' => $request['password']
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return redirect(route('login'))->withErrors([
            'name' => 'The credentials are not correct.'
        ])->onlyInput('username');
    }
}
