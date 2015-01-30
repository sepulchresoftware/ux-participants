<!DOCTYPE html>
<html lang="en">
<head>
	<title>UX Participants - @yield('title', 'Home')</title>
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