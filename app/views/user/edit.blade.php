@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}

	{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

	<div class="control-group">
		{{ Form::label('prenom', 'Prénom', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('prenom') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('nom', 'Nom', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('nom') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('mail', 'Adresse email', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('mail') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('telephone', 'Telephone', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('telephone') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('type', 'Type', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('type') }}
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			{{ Form::submit('Modifier', array('class' => 'btn')); }}
		</div>
	</div>

	{{ Form::close() }}

@stop