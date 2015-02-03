@extends('layouts.master')

@section('title')
Confirm Study Deletion
@stop

@section('content')

<div class="row">
	@if (!empty($success))
	<a href="{{ url('studies') }}" class="btn btn-default">
		<i class="fa fa-arrow-left"></i> Back to Studies
	</a>
	@else
	<a href="{{ url('studies/' . $study->id) }}" class="btn btn-default">
		<i class="fa fa-arrow-left"></i> Back to Study Info
	</a>
	@endif
</div>

@if (empty($success))
<div class="row">
	<p>
		Are you sure you want to delete <strong>{{{ $study->name }}}</strong>?
	</p>
</div>

<div class="row">
	{{ Form::open(array('url' => url('studies/' . $study->id), 'method' => 'DELETE')) }}

		{{ Form::submit('Confirm Deletion', ['class' => 'btn btn-danger'] )}}

	{{ Form::close() }}
</div>
@endif

@stop