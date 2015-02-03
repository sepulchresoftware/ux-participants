@extends('layouts.master')

@section('title')
Create New Study
@stop

@section('content')

<div class="row">
	<a href="{{ url('studies') }}" class="btn btn-default">
		<i class="fa fa-arrow-left"></i> Back to Studies
	</a>
</div>

<div class="row">
	<p>You may use the form below to create a new study.</p>
</div>

<div class="row">
	<div class="col-sm-12 col-md-6 no-left-pad">
		{{ Form::open(array('url' => url('studies'))) }}

			<div class="form-group">
			{{ Form::label('name', 'Name of the Study') }}
			{{ Form::input('text', 'name', '', ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
			{{ Form::label('description', 'Description for the Study') }}
			{{ Form::textarea('description', '', ['class' => 'form-control']) }}
			</div>

			{{ Form::submit('Create Study', ['class' => 'btn btn-primary'] )}}

		{{ Form::close() }}
	</div>
</div>

@stop