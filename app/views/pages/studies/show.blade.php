@extends('layouts.master')

@section('title')
{{{ $study->name }}}
@stop

@section('content')

<div class="row">
	<a href="{{ url('studies') }}" class="btn btn-default">
		<i class="fa fa-arrow-left"></i> Back to Studies
	</a>
	<div class="pull-right">
		<ul class="list-inline">
			<li><a href="{{ url('studies/' . $study->id . '/edit') }}" class="btn btn-success">
				<i class="fa fa-pencil"></i> Edit Study
			</a></li>
			<li><a href="{{ url('studies/' . $study->id . '/delete') }}" class="btn btn-danger">
				<i class="fa fa-times"></i> Delete Study
			</a></li>
		</ul>
	</div>
</div>

<div class="row">
<p>
@if (!empty($study->description))
{{ nl2br(e($study->description)) }}
@else
No description given.
@endif
</p>
</div>

@stop