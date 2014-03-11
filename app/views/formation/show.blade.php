@extends('layouts.master')
@section('content')
	<p>
		{{ $formation->libelle }} {{ $formation->annee }}<br/>
		{{ $formation->conditions }} {{ $formation->id_user }} 
	</p>
@stop