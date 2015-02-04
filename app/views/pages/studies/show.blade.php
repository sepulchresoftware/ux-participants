@extends('layouts.master')

@section('title')
{{{ $study->name }}}
@stop

@section('content')

<div class="row">
	<a href="{{ url('studies') }}" class="btn btn-default">
		<i class="fa fa-arrow-left"></i> Back to Studies
	</a>
	@if (Auth::user()->isAdmin())
	<div class="pull-right">
		<ul class="list-inline">
			<li><a href="{{ url('studies/' . $study->id . '/edit') }}" class="btn btn-success">
				<i class="fa fa-pencil"></i> Edit Study
			</a></li>
			@if (!$study->locked)
			<li><a href="{{ url('studies/' . $study->id . '/lock') }}" class="btn btn-warning">
				<i class="fa fa-lock"></i> Lock Study
			</a></li>
			@else
			<li><a href="{{ url('studies/' . $study->id . '/unlock') }}" class="btn btn-info">
				<i class="fa fa-unlock"></i> Unlock Study
			</a></li>
			@endif
			<li><a href="{{ url('studies/' . $study->id . '/delete') }}" class="btn btn-danger">
				<i class="fa fa-times"></i> Delete Study
			</a></li>
		</ul>
	</div>
	@endif
</div>

<div class="row">
<h4>Status</h4>
<p>
@if (!$study->locked)
This study is available for participation. <strong><a href="{{ url('studies/' . $study->id . '/calendar') }}">Sign Up Now</a></strong>.
@else
This study is <strong>locked</strong> and no longer available for participation.
@endif
</p>
</div>

<div class="row">
<h4>Description</h4>
<p>
@if (!empty($study->description))
{{ nl2br(e($study->description)) }}
@else
No description given.
@endif
</p>
</div>

@stop