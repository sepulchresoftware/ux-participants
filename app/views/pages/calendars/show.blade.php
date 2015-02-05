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
	<p>Please specify up to three date and time slots you would be available for testing.</p>
</div>

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		{{ Form::open() }}

			<div class="form-group">
				{{ Form::label('date-0', 'First Slot') }}
				<div class="input-group">
					{{ Form::input('text', 'date-0', '', ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY hh:mm [AM/PM]']) }}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('date-1', 'Second Slot') }}
				<div class="input-group">
					{{ Form::input('text', 'date-1', '', ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY hh:mm [AM/PM]']) }}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('date-2', 'Third Slot') }}
				<div class="input-group">
					{{ Form::input('text', 'date-2', '', ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY hh:mm [AM/PM]']) }}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
			</div>

			{{ Form::submit('Submit Availability', ['class' => 'btn btn-primary'] )}}

		{{ Form::close() }}
	</div>
</div>

<script type="text/javascript">
	$(function() {
		$('.form-control').datetimepicker({
			'sideBySide': true,
			'daysOfWeekDisabled': [0, 6],
			'format': 'MM/DD/YYYY hh:mm A',
			'useCurrent': false
		});
	});
</script>

<!--
<div class="row">
	<div class="col-sm-offset-1 col-sm-10 calendar">
		<table class="table">
			<thead>
				<tr>
					<th colspan="7">{{{ $calendar->getCurrentMonth()['name'] }}}</th>
				</tr>
			</thead>
			<tbody>
				<tr class="days">
					@foreach($calendar->getDays() as $day)
						<td>{{{ $day }}}</td>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
</div>
-->

@stop