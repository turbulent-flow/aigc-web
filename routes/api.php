<?php

use App\Http\Controllers\API\V0\AIGCController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/tokens/create', function (Request $request) {
    $credentials = [
        'name' => $request->name,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) {
        $token = $request->user()->createToken('api_v0');

        return [
            'token' => $token->plainTextToken
        ];
    }

    return ['code' => 'unauthenticated'];
});

Route::post('/inquire', [AIGCController::class, 'inquire'])->middleware('auth:sanctum');
