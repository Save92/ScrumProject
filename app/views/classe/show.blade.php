@extends('layouts.master')
@section('content')

@include('includes.title', array('name' => 'Classes', 'route' => 'classes'))

	<h1>{{ $classe->libelle }}</h1>
	<p>
		Formation {{ $classe->getFormation() }} - {{ $classe->getResponsable() }}
	</p>

	@include('includes.table',array('items' => $items, 'name' => $name, 'route' => $route, 'actions' => $actions, 'fields' => $fields))
	
@stop