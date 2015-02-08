@extends('layouts.master')

@section('title')
Calendars
@stop

@section('content')

<div class="row">
	<a href="{{ url('studies') }}" class="btn btn-default">
		<i class="fa fa-arrow-left"></i> Back to Studies
	</a>
</div>

@if ($studies->count() > 0)
	<div class="row">
		<h2>Active Calendars</h2>
		<p>Below are all calendars currently accepting new participants:</p>
	</div>
	@foreach ($studies as $study)
	<div class="row">
		<h3>
			<a href="{{ url('calendars/' . $study->id) }}">{{{ $study->name }}}</a>
		</h3>

		@if (!empty($study->description))
			<p>{{ nl2br(e($study->description)) }}</p>
		@endif
	</div>
	@endforeach
@endif

@if($lockedStudies->count() > 0)
	<div class="row">
		<hr />
		<h2>Locked Calendars</h2>
		<p>All study calendars below have been <strong>locked</strong> and are not new accepting participants:</p>
	</div>
	@foreach ($lockedStudies as $lockedStudy)
	<div class="row">
		<h3>
			<a href="{{ url('calendars/' . $lockedStudy->id) }}">
				<i class="fa fa-lock"></i> {{{ $lockedStudy->name }}}
			</a>
		</h3>

		@if (!empty($lockedStudy->description))
			<p>{{ nl2br(e($lockedStudy->description)) }}</p>
		@endif
	</div>
	@endforeach
@endif

@stop