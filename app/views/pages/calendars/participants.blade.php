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

	<div class="col-sm-offset-1 col-sm-10">

		<table class="table">
			<thead>
				<tr>
					<th>Participant</th>
					<th>Time Slot</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($study->participants as $participant)
					<tr>
						<td><a href="{{ url('users/' . $participant->id) }}">{{{ $participant->name }}}</a></td>
						<td>{{{ $participant->pivot->timestamp }}}</td>
						<td>
							@if ($participant->pivot->confirmed)
								<span class="label label-primary"><i class="fa fa-check"></i> Confirmed</span>
							@else
								<span class="label label-default">Available</span>
							@endif
						</td>
						<td>
							@if ($participant->pivot->confirmed)
								<a href="{{ url('calendars/' . $study->id . '/slot/' . $participant->pivot->id . '/clear' . '?month=' . $month . '&year=' . $year) }}" class="btn btn-danger">
									<i class="fa fa-times"></i> Clear Confirmation
								</a>
							@else
								<a href="{{ url('calendars/' . $study->id . '/slot/' . $participant->pivot->id . '/confirm' . '?month=' . $month . '&year=' . $year) }}" class="btn btn-success">
									<i class="fa fa-check"></i> Confirm Time Slot
								</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>

</div>

@stop