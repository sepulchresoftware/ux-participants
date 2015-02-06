@extends('layouts.master')

@section('title')
Submit Availability
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
	<p>On this screen you may submit availability for <strong>{{{ $study->name }}}</strong>.</p>
</div>

<div class="row">
	<p>Please specify up to three date and time slots you would be available for testing.</p>
</div>

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		{{ Form::open() }}

			<div class="form-group">
				{{ Form::label('first-slot', 'First Slot') }}
				<div class="input-group">
					{{ Form::input('text', 'first-slot', '', ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY hh:mm [AM|PM]']) }}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				<span id="first-slot-help" class="help-block" aria-describedby="first-slot">Example: 02/03/2015 02:15 PM</span>
			</div>

			<div class="form-group">
				{{ Form::label('second-slot', 'Second Slot') }}
				<div class="input-group">
					{{ Form::input('text', 'second-slot', '', ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY hh:mm [AM|PM]']) }}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				<span id="second-slot-help" class="help-block" aria-describedby="second-slot">Example: 02/04/2015 10:30 AM</span>
			</div>

			<div class="form-group">
				{{ Form::label('third-slot', 'Third Slot') }}
				<div class="input-group">
					{{ Form::input('text', 'third-slot', '', ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY hh:mm [AM|PM]']) }}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				<span id="third-slot-help" class="help-block" aria-describedby="third-slot">Example: 02/05/2015 03:45 PM</span>
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
			'useCurrent': false,
			'stepping': 15
		});
	});
</script>

@stop