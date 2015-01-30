<!DOCTYPE html>
<html lang="en">
<head>
	<title>UX Participants{{ !empty($title) ? " - $title" : "" }}</title>
</head>
<body>
	<header>
		@include('partials.header')
	</header>

	@yield('content')

	<footer>
		@include('partials.footer')
	</footer>
</body>
</html>