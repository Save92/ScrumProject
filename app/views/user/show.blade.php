@extends('layouts.master')
@section('content')

<div class="panel panel-default">

	<div class="panel-heading">
		@include('includes.title', array('name' => 'Utilisateurs', 'route' => 'users'))
	</div>

	<div class="panel-body">

		<div class="col-sm-2">
			<h3>{{ $item->getName() }}</h3>
			<h4>{{ $item->getRole() }}</h4>
			<p>
				{{ $item->mail }}<br/>
				{{ $item->telephone }}
			</p>
		</div>

		@if($items !== false)
		<div class="well col-sm-10">
			<h4>{{ $name }}</h4>
			<ul class="nav nav-pills">
				@foreach($items as $i)
					@foreach($i as $j)
						<li>
							<a href="{{ URL::to($route).'/'.$j->id }}">{{ $j->getName() }}</a>
						</li>
					@endforeach
				@endforeach
			</ul>
		</div>
		@endif

	</div>

</div>

@stop