@extends('layouts.master')
@section('content')
	<h1>{{ $formation->libelle }} {{ $formation->annee }}</h1>
	<p>
		{{ $formation->conditions }}<br/>
		{{ $formation->getUser() }}
	</p>
@stop