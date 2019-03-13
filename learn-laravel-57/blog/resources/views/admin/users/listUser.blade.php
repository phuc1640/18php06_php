@extends('layouts.admin')
@section('title', 'User Dashboard')
@section('content')
<div style="margin-left: 30px;">
	
	@if (session('isDeleteSuccess') !== null && !session('isDeleteSuccess'))
	<h1>Delete Unsuccessful</h1>
	@endif
	<a href="addUser">Add User</a>
	<h1>List User</h1>
	<style>
		table, th, td {
			border: 1px solid black;
		}
	</style>
	<form action="listUser" method="post" style="margin-bottom: 10px;">
		@csrf
		<input type="text" name="filter" value="">
		<input type="submit" name="submit" value="Search">
	</form>
	<table>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		@isset($users)
		@foreach($users as $user)
		<tr>
			<td>{{$user->name}}</td>
			<td>{{$user->email}}</td>
			<td><a href="editUser?id={{$user->id}}">Edit</a></td>
			<td><a href="deleteUser?id={{$user->id}}">Delete</a></td>
		</tr>
		@endforeach
		@endisset
	</table>
</div>
@endsection