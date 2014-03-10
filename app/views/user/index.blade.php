@extends('layouts.master')
@section('content')

@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<a href="{{ URL::to('users') }}"><h2>Utilisateurs</h2></a>
<a href="{{ URL::to('users/create') }}">Nouveau</a>

<ul>
	@foreach($users as $key => $value)
		<li>
			<h4>{{ $value->first_name }} {{ $value->last_name }}</h4>
			<p>{{ $value->email }}</p>

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