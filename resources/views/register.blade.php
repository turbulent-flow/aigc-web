@extends('layout')

@section('title', 'Register')

@section('content')
<div>Register Form</div>
<form action="{{ route('users.store') }}" method="post">
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
		<label for="passowrd">Password</label>
		<input name="password" type="password" value="{{ old('password') }}" />
	</div>

	<div>
		<label for="password_confirmation">Password Confirmation</label>
		<input name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" />
	</div>

	<div>
		<label for="email">Email</label>
		<input name="email" type="email" value="{{ old('email') }}" />
	</div>

	<div>
		<input type="submit" value="Submit" />
	</div>
</form>
@endsection