@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'classes', 'class' => 'form-horizontal')) }}

	<div class="control-group">
		{{ Form::label('libelle', 'Nom de la classe', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('libelle') }}
		</div>
	</div>

	<div class="control-group">
		{{ Form::label('formation', 'Formation', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::select('formation', $formations) }}
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			{{ Form::submit('Ajouter', array('class' => 'btn')); }}
		</div>
	</div>

	{{ Form::close() }}

@stop