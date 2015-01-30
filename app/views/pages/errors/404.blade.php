@extends('layouts.master')

@section('title')
Not Found
@stop

@section('content')

<div class="row">
	<p>The desired resource could not be located on this server.</p>
	<p>&nbsp;</p>
	<p><a href="{{ url('/') }}">&larr; Back to Home</a></p>
</div>

@stop