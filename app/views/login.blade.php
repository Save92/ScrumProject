@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'login', 'class' => 'form-horizontal')) }}

	<div class="form-group">
		{{ Form::label('mail', 'Adresse email', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
			{{ Form::text('mail', null, array('class' => 'form-control')) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Mot de passe', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
			{{ Form::password('password', array('class' => 'form-control')) }}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			{{ Form::submit('Connexion', array('class' => 'btn btn-primary')); }}
		</div>
	</div>

	{{ Form::close() }}

@stop