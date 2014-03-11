@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'login', 'class' => 'form-horizontal')) }}

	<div class="control-group">
		{{ Form::label('mail', 'Adresse email', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('mail') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('password', 'Mot de passe', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::password('password') }}
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			{{ Form::submit('Connexion', array('class' => 'btn')); }}
		</div>
	</div>

	{{ Form::close() }}

@stop