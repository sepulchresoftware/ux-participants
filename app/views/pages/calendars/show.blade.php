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
	  		<p><i class="fa fa-lock"></i> This study is <strong>locked</strong> and therefore its calendar is not accepting new sign-ups.</p>
	  	</div>
	@endif
</div>

<div class="row">
	<p>This is the calendar for <strong>{{{ $study->name }}}</strong>.</p>
</div>

<div class="row">
	<div class="col-sm-offset-1 col-sm-10 calendar">
		<table class="table">
			<thead>
				<tr>
					<th colspan="7">{{{ $calendar->getMonth() }}}</th>
				</tr>
			</thead>
			<tbody>
				<tr class="days">
					@foreach($calendar->getDays() as $day)
						<td>{{{ $day }}}</td>
					@endforeach
				</tr>
				@for ($i = 0; $i < $calendar->getDaysInMonth(); $i++)
					
					

				@endfor
			</tbody>
		</table>
	</div>
</div>

@stop