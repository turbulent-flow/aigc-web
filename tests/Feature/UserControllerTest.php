<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('The process should create a user', function () {
    $request = [
        'username' => 'fake-name',
        'password' => 'fake-password',
        'password_confirmation' => 'fake-password',
        'email' => 'fake@example.com'
    ];

    $response = $this->post(route('users.store'), $request);

    $response->assertValid();

    $user = DB::table('users')->where('name', 'fake-name')->first();

    $this->assertEquals($user->name, $request['username']);
    $this->assertTrue(Hash::check($request['password'], $user->password));
    $this->assertEquals($user->email, $request['email']);
});

test('The validation should be failed', function () {
    $request = [
        'username' => 'fake-name',
        'password' => 'fake-password'
    ];

    $response = $this->post(route('users.store', $request));

    $response->assertInvalid(['password', 'email']);
});
