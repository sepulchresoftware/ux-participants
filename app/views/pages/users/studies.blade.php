@extends('layouts.master')

@section('title')
My Studies
@stop

@section('content')

<div class="row">
	<p>On this page you may view a table of all studies for which you have listed availability.</p>
</div>

<div class="row">

	@if ($studies->count() > 0)
		<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

			<table class="table">
				<thead>
					<tr>
						<th>Study</th>
						<th>Slot</th>
						<th>Slot Confirmed?</th>
					</tr>
				</thead>
				<tbody>
					@foreach($studies as $study)
						<tr>
							<td><a href="{{ url('studies/' . $study->id) }}">{{{ $study->name }}}</a></td>
							<td>{{{ $study->pivot->timestamp }}}</td>
							<td>
								@if ($study->pivot->confirmed)
									<span class="label label-primary">
										<i class="fa fa-check"></i> Confirmed!
									</span>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	@else
		<p><strong>You have not provided availability for any studies yet.</strong></p>
	@endif

</div>

@stop