@extends('layouts.master')
@section('content')

@include('includes.title', array('name' => 'Classes', 'route' => 'classes'))

	<h1>{{ $classe->libelle }}</h1>
	<h4>Formation: {{ $formation }}</h4>
	<p>
		{{ Form::label('user', 'Secrétaire pédagogique', array('class' => 'control-label')) }}
		{{ User::find($classe->id_user)->getName() }}
	</p>

	<p>
		Eleves :

		<div class="col-sm-4">
			<ul class="list-group">
				@foreach($students as $key => $value)
					<li class="list-group-item">{{ $value->prenom.' '.$value->nom }}</li>
				@endforeach
			</ul>
		</div>
	</p>

	<!--<a class="btn btn-small btn-success" href="{{ URL::to('classes/'.$classe->id.'/add') }}" style="clear: both;">Ajouter un élève</a>-->
	<a class="btn btn-small btn-success" href="#" style="clear: both;">Ajouter un élève</a>
@stop