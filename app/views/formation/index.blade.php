@extends('layouts.master')
@section('content')

<a href="{{ URL::to('formations') }}"><h2>Formations</h2></a>
<a href="{{ URL::to('formations/create') }}" class="btn btn-small btn-primary">Nouveau</a>

<ul>
	@foreach($formations as $key => $value)
		<li>
			<h3>{{ $value->libelle }} {{ $value->annee }}</h3>
			<p>{{ $value->conditions }}</p>

			<a class="btn btn-small btn-success" href="{{ URL::to('formations/' . $value->id) }}">Afficher</a>

			<a class="btn btn-small btn-info" href="{{ URL::to('formations/' . $value->id . '/edit') }}">Modifier</a>

			{{ Form::open(array('url' => 'formations/' . $value->id)) }}
				{{ Form::hidden('_method', 'DELETE') }}
				{{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
			{{ Form::close() }}

		</li>
	@endforeach
</ul>

</div>
@stop