@extends('layouts.master')

@section('title')
Calendar View
@stop

@section('content')

<div class="row">
	<a href="{{ url('studies/' . $study->id) }}" class="btn btn-default">
		<i class="fa fa-arrow-left"></i> Back to Study Info
	</a>
</div>

<div class="row">
	@if ($study->locked)
		<div class="alert alert-info alert-dismissible" role="alert">
	  		<p><i class="fa fa-lock"></i> This study is <strong>locked</strong> and therefore its calendar is not accepting new sign-ups.</p>
	  	</div>
	@endif
</div>

<div class="row">
	<p>This is the calendar for <strong>{{{ $study->name }}}</strong>.</p>
</div>

<div class="row">
	<div class="col-sm-offset-1 col-sm-10 calendar">
		{{ $calendar }}
	</div>
</div>

@stop