@extends('layouts.master')
@section('content')
	<h1>{{ $user->getName() }}</h1>
	<p>
		{{ $user->getRole() }}<br/>
		{{ $user->telephone }}<br/>
		{{ $user->mail }}
	</p>
@stop