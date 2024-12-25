@extends('layout')

@section('title', 'Login')

@section('content')
<div>Login Form</div>
<form action="{{ route('login') }}" method="post">
    @csrf

    <div>
        <label for="username">Username</label>
        <input name="username" type="text" value="{{ old('username') }}" />
    </div>

    <div>
        <label for="password">Password</label>
        <input name="password" type="password" />
    </div>

    <div>
        <input type="submit" value="Login" />
    </div>
</form>
@endsection