<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ URL::route('home') }}">Intranet</a>
		</div>

		@if(Auth::check())
		<ul class="nav navbar-nav">

		{{-- MENU --}}
		@if(Session::get('role') > 2)
			<li {{ ( Request::is('users') || Request::is('users/*') ) ? 'class="active"' : '' }}>
				<a href="{{ URL::to('users') }}">
					Utilisateurs
				</a>
			</li>
			<li {{ ( Request::is('formations') || Request::is('formations/*') ) ? 'class="active"' : '' }}>
				<a href="{{ URL::to('formations') }}">
					Formations
				</a>
			</li>
			<li {{ ( Request::is('matieres') || Request::is('matieres/*') ) ? 'class="active"' : '' }}>
				<a href="{{ URL::to('matieres') }}">
					Matières
				</a>
			</li>
		@endif
			<li {{ ( Request::is('classes') || Request::is('classes/*') ) ? 'class="active"' : '' }}>
				<a href="{{ URL::to('classes') }}">
					Classes
				</a>
			</li>

		</ul>
		@endif

		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="{{ URL::to('db') }}"><strong>DB</strong></a>
			</li>
		@if(Auth::check())
			<li {{ ( Request::is('users/'.Auth::user()->id) ) ? 'class="active"' : '' }}>
				<a href="{{ URL::to('users/'.Auth::user()->id) }}">
					{{ Auth::user()->prenom }} {{ Auth::user()->nom }} ( {{ Auth::user()->getRole() }} )
				</a>
			</li>
			<li>
				<a href="{{ URL::to('logout') }}">
					Déconnexion
				</a>
			</li>
		@else
			<li {{ ( Request::is('login') ) ? 'class="active"' : '' }}>
				<a href="{{ URL::to('login') }}">
					Connexion
				</a>
			</li>
		@endif
		</ul>
	</div>
</nav>

@if (Session::has('message'))
	<div class="alert alert-dismissable alert-{{ Session::has('alert') ? Session::get('alert') : 'info' }}">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ Session::get('message') }}
	</div>
@endif