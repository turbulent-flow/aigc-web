<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        $user = User::with('aigcToken')->find(Auth::id());

        return view('index', [
            'user' => $user
        ]);
    }
}
