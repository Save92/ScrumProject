@extends('layouts.master')
@section('content')
	{{ HTML::show_user($user, true) }}
	<a href="{{ URL::to('users') }}">
		<button type="button" class="btn btn-primary">
		<span class="glyphicon glyphicon-chevron-left"></span>
		</button>
	</a>
@stop