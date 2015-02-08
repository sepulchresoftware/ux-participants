@extends('layouts.master')

@section('title')
My Profile
@stop

@section('content')

<div class="row">
	<p>On this page you may view a summary of your profile information.</p>
</div>

<div class="row">

	<h3>Username</h3>
	<p>{{{ $user->uid }}}</p>

</div>

<div class="row">

	<h3>Name</h3>
	<p>{{{ $user->name }}}</p>

</div>

<div class="row">

	<h3>Email Address</h3>
	<p>{{{ $user->email }}}</p>

</div>

<div class="row">

	<h3>Account Type</h3>
	<p>{{{ $user->role->name }}}</p>

</div>

</div>

@stop