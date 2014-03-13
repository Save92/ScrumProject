@extends('layouts.master')
@section('content')

@include('includes.title', array('name' => $name, 'route' => $route))

	<h1>{{ $formation->libelle }} {{ $formation->annee }}</h1>
	<p>
		Conditions : {{ $formation->conditions }}<br/>
		Secrétaire pédagogique : {{ $formation->getUser() }}
	</p>

	@include('includes.table',array('items' => $items, 'name' => $name, 'route' => $route, 'actions' => $actions, 'fields' => $fields))

@stop