<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AIGCToken;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\CreateUserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showForm(): View
    {
        return view('register');
    }

    public function createUser(CreateUserRequest $request): RedirectResponse
    {
        $request->validated();

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name' => $request['username'],
                'password' => Hash::make($request['password']),
                'email' => $request['email']
            ]);

            AIGCToken::create([
                'user_id' => $user->id,
                'type' => 'normal',
                'available_numbers' => 5,
                'expired_at' => Carbon::now()->add(24, 'hour')
            ]);
        });

        return redirect(route('showLoginForm'));
    }
}
