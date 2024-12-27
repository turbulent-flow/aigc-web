<?php

use App\Models\AIGCToken;
use App\Models\User;

test('The index page should be accessed', function () {
    $user = User::factory()->create();

    AIGCToken::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->get('/');

    $response->assertSuccessful();
});

test('The index page should not be accessed', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('showLoginForm'));
    $this->assertGuest();
});
