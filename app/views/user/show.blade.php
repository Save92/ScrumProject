@extends('layouts.master')
@section('content')
	<p>
		{{ $user->first_name }} {{ $user->last_name }}<br/>
		{{ $user->email }}
	</p>
@stop