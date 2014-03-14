@extends('layouts.master')
@section('content')

<div class="panel panel-default">

	<div class="panel-heading">
		@include('includes.title', array('name' => 'Utilisateurs', 'route' => 'users'))
	</div>

	<div class="panel-body">

		<h3>{{ $item->getName() }}</h3>
		<p>
			{{ $item->getRole() }}<br/>
			{{ $item->mail }}<br/>
			{{ $item->telephone }}
		</p>

		<h4>{{ $name }}</h4>
		@foreach($items as $i)
			@foreach($i as $j)
				{{ $j->getName() }}
			@endforeach
		@endforeach

	</div>

</div>

@stop