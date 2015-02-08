<!DOCTYPE html>
<html lang="en">
<head>
	<title>UX Participants - @yield('title', 'Home')</title>

	<link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('bower_components/components-font-awesome/css/font-awesome.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/calendar.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}" />

	<script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

	<meta name="description" content="Simple system for management of potential participants in a UX study" /> 
    <meta name="keywords" content="management,participant,participants,ux,study" /> 
    <meta name="version" content="1.0.0" />
    <meta name="author" content="Matthew Fritz and Juan Atachagua (sepulchre@burbankparanormal.com) (natachagua@gmail.com)." /> 
    <meta name="company" content="Sepulchre Software" /> 
    <meta name="copyright" content="Copyright (c) {{ date('Y') }} Sepulchre Software" /> 
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<header>
		@include('partials.header')
	</header>

	<div class="container">
		<div class="row">
			<h1>@yield('title', 'Welcome')</h1>
		</div>

		@if ($errors->count() > 0)
		<div class="row">
			<div class="alert alert-danger alert-dismissible" role="alert">
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
  				</button>
				<p>The following errors occurred:</p>
				<p>&nbsp;</p>
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
				</ul>
			</div>
		</div>
		@elseif (!empty($success))
			<div class="row">
				<div class="alert alert-success alert-dismissible" role="alert">
	  				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	  					<span aria-hidden="true">&times;</span>
	  				</button>
	  				<p>{{ $success }}</p>
	  			</div>
			</div>
		@endif

		@yield('content')
	</div>

	<footer>
		@include('partials.footer')
	</footer>
</body>
</html>