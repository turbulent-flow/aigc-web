<?php

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('The login should authenticate the user', function () {
    $user = User::factory()->create([
        'name' => 'fake-name',
        'email' => 'fake@example.com',
        'password' => Hash::make('fpassword')
    ]);

    $response = $this->post(route('login'), [
        'username' => 'fake-name',
        'password' => 'fpassword'
    ]);

    $response->assertValid();
    $response->assertRedirect(route('index'));
    $this->assertAuthenticatedAs($user);
});

test('The login should not pass', function () {
    $user = User::factory()->create([
        'name' => 'fake-name',
        'email' => 'fake@example.com',
        'password' => Hash::make('fpassword')
    ]);

    $response = $this->post(route('login'), [
        'username' => 'fake-name',
        'password' => 'password'
    ]);

    $response->assertInvalid([
        'name' => 'The credentials are not correct.'
    ]);

    $response->assertRedirect(route('showLoginForm'));
    $this->assertGuest();
});

test('The logout should sign out', function () {
    $user = User::factory()->create([
        'name' => 'fake-name',
        'email' => 'fake@example.com',
        'password' => Hash::make('fpassword')
    ]);


    $this->post(route('login'), [
        'username' => 'fake-name',
        'password' => 'fpassword'
    ]);

    $response = $this->get(route('logout'));

    $response->assertRedirect(route('showLoginForm'));
    $this->assertGuest();
});
