@extends('layouts.master')

@section('title')
Participants
@stop

@section('content')

<div class="row">
	<a href="{{ url('calendars/' . $study->id . '?month=' . $month . '&year=' . $year) }}" class="btn btn-default">
		<i class="fa fa-arrow-left"></i> Back to Calendar
	</a>
</div>

<div class="row">
	@if ($study->locked)
		<div class="alert alert-info alert-dismissible" role="alert">
	  		<p><i class="fa fa-lock"></i> This study is <strong>locked</strong> and therefore its calendar is not accepting new participants.</p>
	  	</div>
	@else
		<p>On this page you can see all available and confirmed participants for <strong>{{{ $study->name }}}</strong>.</p>
	@endif
</div>

<div class="row">



</div>

@stop