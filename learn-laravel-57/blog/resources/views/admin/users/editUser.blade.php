@extends('layouts.admin')
@section('title', 'Edit User')
@section('content')
<div style="margin-left: 30px;">
	<a href="listUser">List User</a>
	@isset($success)
	@if (!$success)
	<h1>Re-Enter</h1>
	@endif
	@endisset

	@isset($user)

	<h1>Edit User</h1>
	<form action="{{Route('editUser')}}" method="POST">
		@csrf
		<input type="hidden" name="id" value="{{$user->id}}">
		<p>Name : <input type="text" name="name" value="{{$user->name}}"></p>
		<p>Email : <input type="text" name="email" value="{{$user->email}}"></p>
		<p>Password : <input type="password" name="password"></p>
		<p>Re-Enter Password : <input type="password" name="validatePassword"></p>
		<p><input type="submit" name="editUser" value="Edit User"></p>
	</form>

	@endisset
</div>

@endsection