<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm(): View
    {
        return view('login');
    }

    public function login(UserLoginRequest $request): RedirectResponse
    {
        $request->validated();

        $credentials = [
            'name' => $request['username'],
            'password' => $request['password']
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('index'));
        }

        return redirect(route('showLoginForm'))->withErrors([
            'name' => 'The credentials are not correct.'
        ])->onlyInput('username');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('showLoginForm'));
    }
}
