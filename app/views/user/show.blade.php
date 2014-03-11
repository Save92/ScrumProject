@extends('layouts.master')
@section('content')
	<p>
		{{ $user->id_role }} {{ $user->prenom }} {{ $user->nom }}<br/>
		{{ $user->telephone }}<br/>
		{{ $user->mail }}
	</p>
@stop