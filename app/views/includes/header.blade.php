<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ URL::route('home') }}">Intranet</a>
		</div>

		@if(Auth::check())
		<ul class="nav navbar-nav">
			{{ HTML::clever_link("users", 'Utilisateurs' ) }}
			{{ HTML::clever_link("formations", 'Formations' ) }}
			{{ HTML::clever_link("classes", 'Classes' ) }}
		</ul>
		@endif

		<ul class="nav navbar-nav navbar-right">
		@if(Auth::check())
			<li>
				<a href="{{ URL::to('users/'.Auth::user()->id) }}">
					( {{ Auth::user()->prenom }} {{ Auth::user()->nom }} )
				</a>
			</li>
			<li>
				<a href="{{ URL::to('logout') }}">
					Déconnexion
				</a>
			</li>
		@else
			<li>
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