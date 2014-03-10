@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}

	{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}

		{{ Form::label('first_name', 'Prénom') }}
		{{ Form::text('first_name') }}

		{{ Form::label('last_name', 'Nom') }}
		{{ Form::text('last_name') }}

		{{ Form::label('email', 'Adresse email') }}
		{{ Form::text('email') }}

		{{ Form::submit(); }}

	{{ Form::close() }}

@stop