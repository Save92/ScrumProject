@extends('layouts.master')
@section('content')
	<p>
		{{ $matiere->libelle }}<br/>
		{{ $matiere->id_thematique }}
	</p>
@stop