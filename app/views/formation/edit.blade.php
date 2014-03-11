@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}

	{{ Form::model($formation, array('route' => array('formations.update', $formation->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

	<div class="control-group">
		{{ Form::label('libelle', 'Libellé', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('libelle') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('annee', 'Année', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('annee') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('conditions', 'Conditions', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('conditions') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('id_user', 'Secrétaire pédagogique', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('id_user') }}
		</div>
	</div>





	<div class="control-group">
		<div class="controls">
			{{ Form::submit('Modifier', array('class' => 'btn')); }}
		</div>
	</div>

	{{ Form::close() }}

@stop