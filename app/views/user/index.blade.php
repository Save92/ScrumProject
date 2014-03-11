@extends('layouts.master')
@section('content')

<a href="{{ URL::to('users') }}"><h2>Utilisateurs</h2></a>
<a href="{{ URL::to('users/create') }}" class="btn btn-small btn-primary">Nouveau</a>



<ul>
	@foreach($users as $key => $value)
		<li>
			<h4>{{ $value->id_role }} {{ $value->prenom }} {{ $value->nom }}</h4>
			<p>{{ $value->mail }}</p>

			<p>

				<a class="btn btn-small btn-success" href="{{ URL::to('users/' . $value->id) }}">Afficher</a>

				<a class="btn btn-small btn-info" href="{{ URL::to('users/' . $value->id . '/edit') }}">Modifier</a>

				{{ Form::open(array('url' => 'users/' . $value->id)) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Supprimer', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}

			</p>
		</li>
	@endforeach
</ul>

</div>
@stop