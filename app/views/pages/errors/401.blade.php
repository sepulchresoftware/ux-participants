@extends('layouts.master')

@section('title')
Access Denied
@stop

@section('content')

<div class="row">
	<p>You do not have permission to access this resource.</p>
	<p>&nbsp;</p>
	<p><a href="{{ url('/') }}">&larr; Back to Home</a></p>
</div>

@stop