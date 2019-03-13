@extends('layouts.admin')
@section('title', 'Add User')
@section('content')
<div style="margin-left: 30px;">
	<a href="listUser">List User</a>
	@isset($success)
	@if (!$success)
	<h1>Re-Enter</h1>
	@endif
	@endisset

	<h1>Add User</h1>
	<form action="{{Route('addUser')}}" method="POST">
		@csrf
		<p>Name : <input type="text" name="name" value="{{$user->name}}"></p>
		<p>Email : <input type="text" name="email" value="{{$user->email}}"></p>
		<p>Password : <input type="password" name="password" value="{{$user->password}}"></p>
		<p>Re-Enter Password : <input type="password" name="validatePassword" value="{{$user->validatePassword}}"></p>
		<p><input type="submit" name="addUser" value="Add User"></p>
	</form>
</div>

@endsection