<nav>
	<ul>
		<li><a class="btn btn-small" href="{{ URL::to('/') }}"><h1>Intranet</h1></a></li>
		@if(Auth::check())
			<li><a class="btn btn-small" href="{{ URL::to('users') }}">Utilisateurs</a></li>
			<li><a class="btn btn-small" href="{{ URL::to('formations') }}">Formations</a></li>
			<li><a class="btn btn-small" href="{{ URL::to('logout') }}">Déconnexion</a></li>
		@else
			<li><a class="btn btn-small" href="{{ URL::to('login') }}">Connexion</a></li>
		@endif
	</ul>
</nav>

@if (Session::has('message'))
	<div class="alert alert-{{ Session::has('alert') ? Session::get('alert') : 'info' }}">
		{{ Session::get('message') }}
	</div>
@endif