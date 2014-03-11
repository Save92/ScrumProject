@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'login')) }}

		{{ Form::label('email', 'Adresse email') }}
		{{ Form::text('email') }}

		{{ Form::label('password', 'Mot de passe') }}
		{{ Form::password('password') }}

		{{ Form::submit('Login'); }}

	{{ Form::close() }}

@stop