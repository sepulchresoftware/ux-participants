<!-- Begin Navigation -->

<nav class="navbar navbar-inverse navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="{{ url('/') }}">UX Participants</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li><a href="{{ url('/') }}">Home</a></li>

			@if (Auth::check())
			<li><a href="#">Studies</a></li>
			@endif
		</ul>
		<ul class="nav navbar-nav navbar-right">
			@if (Auth::check())
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{{ Auth::user()->name }}} <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">My Studies</a></li>
					<li><a href="#">My Profile</a></li>
					@if (Auth::user()->isAdmin())
					<li><a href="#">Admin Panel</a></li>
					@endif
					<li role="presentation" class="divider"></li>
					<li><a href="{{ url('auth/logout') }}">Logout</a></li>
				</ul>
			</li>
			@else
			<li><a href="{{ url('auth/login?return=' . urlencode(URL::full())) }}">Login</a></li>
			@endif
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>

<!-- End Navigation -->