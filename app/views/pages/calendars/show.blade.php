@extends('layouts.master')

@section('title')
Calendar View
@stop

@section('content')

<div class="row">
	<a href="{{ url('calendars') }}" class="btn btn-default">
		<i class="fa fa-arrow-left"></i> Back to Calendars
	</a>
</div>

<div class="row">
	@if ($study->locked)
		<div class="alert alert-info alert-dismissible" role="alert">
	  		<p><i class="fa fa-lock"></i> This study is <strong>locked</strong> and therefore its calendar is not accepting new participants.</p>
	  	</div>
	@endif
</div>

<div class="row">
	<p>This is the calendar showing all available participants for <strong>{{{ $study->name }}}</strong>.</p>
</div>

<div class="row">
	<div class="col-sm-offset-1 col-sm-10 calendar">
		{{ $calendar->render() }}
	</div>
</div>

@stop