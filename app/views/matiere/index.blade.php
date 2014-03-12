@extends('layouts.master')
@section('content')

@include('includes.title', array('name' => 'Matières', 'route' => 'matieres'))

<ul>
	@foreach($matieres as $key => $value)
		<li>
			<h3>{{ $value->libelle }}</h3>
			<p>{{ $value->id_thematique }}</p>

			<a class="btn btn-small btn-success" href="{{ URL::to('matieres/' . $value->id) }}">Afficher</a>

			<a class="btn btn-small btn-info" href="{{ URL::to('matieres/' . $value->id . '/edit') }}">Modifier</a>

			{{ Form::open(array('url' => 'matieres/' . $value->id)) }}
				{{ Form::hidden('_method', 'DELETE') }}
				{{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
			{{ Form::close() }}

		</li>
	@endforeach
</ul>

@stop