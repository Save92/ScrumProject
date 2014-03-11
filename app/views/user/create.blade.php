@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'users', 'class' => 'form-horizontal')) }}

	<div class="control-group">
		{{ Form::label('first_name', 'Prénom', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('first_name') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('last_name', 'Nom', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('last_name') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('email', 'Adresse email', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('email') }}
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			{{ Form::submit('Ajouter', array('class' => 'btn')); }}
		</div>
	</div>

	{{ Form::close() }}

@stop