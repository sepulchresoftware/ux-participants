@extends('layouts.master')

@section('title')
{{{ $study->name }}}
@stop

@section('content')

<div class="row">
	<a href="{{ url('studies') }}" class="btn btn-default">
		<i class="fa fa-arrow-left"></i> Back to Studies
	</a>
</div>

<div class="row">
{{ nl2br(e($study->description)) }}
</div>

@stop