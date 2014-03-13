@extends('layouts.master')
@section('content')

@include('includes.title', array('name' => 'Matières', 'route' => 'matieres'))

	<p>
		Nom : {{ $matiere->libelle }}<br/>
		Coefficient : {{ $matiere->coef }} <br/>
		Formation : {{ $matiere->id_formation }} <br/>
		Thématique : {{ $matiere->id_thematique }}
	</p>

@stop