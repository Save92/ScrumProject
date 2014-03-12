@extends('layouts.master')
@section('content')

@include('includes.title', array('name' => 'Utilisateurs', 'route' => 'users'))

	<h3>{{ $user->getName() }}</h3>
	<p>
		{{ $user->getRole() }}<br/>
		{{ $user->mail }}<br/>
		{{ $user->telephone }}
	</p>


	<a href="{{ URL::to('users') }}">
		<button type="button" class="btn btn-default">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</button>
	</a>

	@if(Session::get('role') >= 5)
		<!-- Administrateur -->
		@include('includes.actions', array('url' => 'users/'.$user->id, 'readEditDelete' => array(0,1,1)))
	@elseif(Session::get('role') >= 4)
		<!-- Secrétaire pédagogique -->
		@include('includes.actions', array('url' => 'users/'.$user->id, 'readEditDelete' => array(0,1,0)))
	@endif
@stop