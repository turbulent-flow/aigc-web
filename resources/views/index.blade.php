@extends('layout')

@section('title', 'Index')

@section('content')
<div>Hi, {{ $user->name }}!</div>
<div>Welcome to the realm of AIGC! You have {{ $user->aigcToken->available_numbers }} tokens to consume, just enjoy your time!</div>
@endsection