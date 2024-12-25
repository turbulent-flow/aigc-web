<?php

use App\Models\AIGCToken;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('The registration should create a user', function () {
    $request = [
        'username' => 'fake-name',
        'password' => 'fake-password',
        'password_confirmation' => 'fake-password',
        'email' => 'fake@example.com'
    ];

    $response = $this->post(route('register'), $request);

    $response->assertValid();

    $user = User::with('aigcToken')->where('name', 'fake-name')->get()->first();

    $this->assertEquals($user->name, $request['username']);
    $this->assertTrue(Hash::check($request['password'], $user->password));
    $this->assertEquals($user->email, $request['email']);
    $this->assertInstanceOf(AIGCToken::class, $user->aigcToken);
    $this->assertEquals($user->aigcToken->user_id, $user->id);
    $response->assertRedirect(route('showLoginForm'));
});

test('The registration should return a validation error', function () {
    $request = [
        'username' => 'fake-name',
        'password' => 'fake-password'
    ];

    $response = $this->post(route('register', $request));

    $response->assertInvalid(['password', 'email']);
});
