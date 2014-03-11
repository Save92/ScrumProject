@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'matieres', 'class' => 'form-horizontal')) }}

	<div class="control-group">
		{{ Form::label('libelle', 'Libellé', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('libelle') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('id_thematique', 'id Thématique', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('id_thematique') }}
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			{{ Form::submit('Ajouter', array('class' => 'btn')); }}
		</div>
	</div>

	{{ Form::close() }}

@stop