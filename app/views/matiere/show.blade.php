@extends('layouts.master')
@section('content')

@include('includes.title', array('name' => 'Matières', 'route' => 'matieres'))

	<p>
		{{ $matiere->libelle }}<br/>
		{{ $matiere->id_thematique }}
	</p>

@stop