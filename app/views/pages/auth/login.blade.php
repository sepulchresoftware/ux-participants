@extends('layouts.master')

@section('title')
Sign In
@stop

@section('content')

<div class="row">

	<div class="col-sm-6 no-left-pad margin-top-10">
	{{ Form::open(array('url' => URL::full())) }}

		<div class="form-group">
		{{ Form::label('username', 'Username') }}
		{{ Form::input('text', 'username', '', ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
		{{ Form::label('password', 'Password') }}
		{{ Form::input('password','password', '', ['class' => 'form-control']) }}
		</div>

		{{ Form::submit('Sign In', ['class' => 'btn btn-primary'] )}}

	{{ Form::close() }}
	</div>

</div>

@stop