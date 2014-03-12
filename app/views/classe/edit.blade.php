@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}

	{{ Form::model($classe, array('route' => array('classes.update', $classe->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

	<div class="control-group">
		{{ Form::label('libelle', 'Nom de la promo', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('libelle') }}
		</div>
	</div>

	<div class="control-group">
		<strong>Diplôme:</strong> {{ $classe->id }}
	</div>

	<div class="control-group">
		<div class="controls">
			{{ Form::submit('Modifier', array('class' => 'btn')); }}
		</div>
	</div>

	{{ Form::close() }}

@stop