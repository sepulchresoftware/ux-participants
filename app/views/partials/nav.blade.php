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
			<li @if ($active_nav == "home") class="active" @endif>
				<a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
			</li>
			@if (Auth::check())
			<li @if ($active_nav == "studies") class="active" @endif>
				<a href="{{ url('studies') }}"><i class="fa fa-book"></i> Studies</a>
			</li>
				@if (Auth::user()->isAdmin())
					<li @if ($active_nav == "calendars") class="active" @endif>
						<a href="{{ url('calendars') }}"><i class="fa fa-calendar"></i> Calendars</a>
					</li>
				@endif
			@endif
		</ul>
		<ul class="nav navbar-nav navbar-right">
			@if (Auth::check())
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-user"></i> {{{ Auth::user()->name }}} <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					@if (Auth::user()->isAdmin())
					<!--<li @if ($active_nav == "admin") class="active" @endif>
						<a href="{{ url('admin') }}"><i class="fa fa-wrench"></i> Admin Panel</a>
					</li>-->
					<li role="presentation" class="divider"></li>
					@endif
					<li @if ($active_nav == "my-studies") class="active" @endif>
						<a href="{{ url('users/' . Auth::user()->id . '/studies') }}"><i class="fa fa-folder"></i> My Studies</a>
					</li>
					<li @if ($active_nav == "my-profile") class="active" @endif>
						<a href="{{ url('users/' . Auth::user()->id) }}"><i class="fa fa-info-circle"></i> My Profile</a>
					</li>
					<li role="presentation" class="divider"></li>
					<li><a href="{{ url('auth/logout') }}"><i class="fa fa-unlock"></i> Sign Out</a></li>
				</ul>
			</li>
			@else
			<li @if ($active_nav == "login") class="active" @endif>
				<a href="{{ url('auth/login?return=' . urlencode(URL::full())) }}"><i class="fa fa-key"></i> Sign In</a>
			</li>
			@endif
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>

<!-- End Navigation -->