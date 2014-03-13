@extends('layouts.master')
@section('content')

<div class="panel panel-default">

	<div class="panel-heading">
		@include('includes.title', array('name' => 'Utilisateurs', 'route' => 'users'))
	</div>

	<div class="panel-body">

		<h3>{{ $user->getName() }}</h3>
		<p>
			{{ $user->getRole() }}<br/>
			{{ $user->mail }}<br/>
			{{ $user->telephone }}
		</p>

	</div>

</div>

@stop