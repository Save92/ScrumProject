@extends('layouts.master')
@section('content')

	<?php $table = 'users' ?>

	<h3>{{ $user->getName() }}</h3>
	<p>
		{{ $user->getRole() }}<br/>
		{{ $user->mail }}<br/>
		{{ $user->telephone }}
	</p>


	<a href="{{ URL::to($table) }}">
		<button type="button" class="btn btn-primary">
		<span class="glyphicon glyphicon-chevron-left"></span>
		</button>
	</a>

	@if(Session::get('role') >= 5)
		<!-- Administrateur -->
		{{ HTML::crud($table.'/'.$user->id, array(0,1,1)) }}
	@elseif(Session::get('role') >= 4)
		<!-- Secrétaire pédagogique -->
		{{ HTML::crud($table.'/'.$user->id, array(0,1,0)) }}
	@endif
@stop