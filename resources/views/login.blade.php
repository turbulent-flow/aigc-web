@extends('layout')

@section('title', 'Login')

@section('content')
<div>Login Form</div>
<form action="{{ route('login') }}" method="post">
    @csrf

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

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