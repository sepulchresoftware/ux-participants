@extends('layouts.master')

@section('title')
Available Studies
@stop

@section('content')

@if (Auth::user()->isAdmin())
	<div class="row">
		<a href="{{ url('studies/create') }}" class="btn btn-primary pull-right">
			<i class="fa fa-plus"></i> Create New Study
		</a>
	</div>
@endif

@if ($studies->count() == 0)
	<div class="row">
		<p>There are no studies currently available for participation.</p>
	</div>
@else
	<div class="row">
		<p>Below are all studies currently available for participation:</p>
	</div>
	@foreach ($studies as $study)
	<div class="row">
		<h3>
			<a href="{{ url('studies/' . $study->id) }}">{{{ $study->name }}}</a>
		</h3>

		@if (!empty($study->description))
			<p>{{ nl2br(e($study->description)) }}</p>
		@endif
	</div>
	@endforeach
@endif

@if($lockedStudies->count() > 0 && Auth::user()->isAdmin())
	<div class="row">
		<hr />
		<h2>Locked Studies</h2>
		<p>All studies below have been <strong>locked</strong> and are not accepting new participants:</p>
	</div>
	@foreach ($lockedStudies as $lockedStudy)
	<div class="row">
		<h3>
			<a href="{{ url('studies/' . $lockedStudy->id) }}">
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