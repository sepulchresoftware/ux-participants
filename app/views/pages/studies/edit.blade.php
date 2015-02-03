@extends('layouts.master')

@section('title')
Edit Study
@stop

@section('content')

<div class="row">
	<a href="{{ url('studies/' . $study->id) }}" class="btn btn-default">
		<i class="fa fa-arrow-left"></i> Back to Study Info
	</a>
</div>

<div class="row">
	<p>You may use the form below to modify the existing study.</p>
</div>

<div class="row">
	<div class="col-sm-12 col-md-6 no-left-pad">
		{{ Form::open(array('url' => url('studies/' . $study->id), 'method' => 'PUT')) }}

			<div class="form-group">
			{{ Form::label('name', 'Name of the Study') }}
			{{ Form::input('text', 'name', $study->name, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
			{{ Form::label('description', 'Description for the Study') }}
			{{ Form::textarea('description', $study->description, ['class' => 'form-control']) }}
			</div>

			{{ Form::submit('Modify Study', ['class' => 'btn btn-primary'] )}}

		{{ Form::close() }}
	</div>
</div>

@stop