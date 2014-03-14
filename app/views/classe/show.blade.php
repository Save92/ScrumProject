@extends('layouts.master')
@section('content')

@include('includes.title', array('name' => 'Classes', 'route' => 'classes'))

	<h1>{{ $classe->libelle }}</h1>
	<p>
		{{ $classe->getFormation() }} - {{ $classe->getResponsable() }}
	</p>


		<form method="POST" action="{{ URL::to('add/'.$classe->id) }}" role="form" class="form-horizontal" style="margin-bottom: 20px;">

			<select name="id_user" style="">
				@if(count($candidats) > 0) echo 'ok'
					@foreach($candidats as $k => $v)
						<option value="{{ $v['id'] }}">{{ $v['prenom'] }} {{ $v['nom'] }}</option>
					@endforeach
				@endif
			</select>

			<input type="hidden" value="{{ $classe->id }}">

			<input type="submit" class="btn btn-primary" value="Ajouter un étudiant">

		</form>

	@include('includes.table',array('items' => $items, 'name' => $name, 'route' => $route, 'actions' => $actions, 'fields' => $fields))
	
@stop