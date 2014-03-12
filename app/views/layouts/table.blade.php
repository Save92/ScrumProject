<!--
array(
	'items' => $exemples,
	'name' => 'Exemples',
	'route' => 'exemples',
	'fields' => array(
		// Contient le nom du champ et le nom de la fonction (models) qui renvoie la valeur
		'Exemple' => 'getExemple',
		'Exemple' => 'getExemple'
	)
)
-->

@extends('layouts.master')
@section('content')

<div class="panel panel-default">

	<div class="panel-heading">
		@include('includes.title', array('name' => $name, 'route' => $route))
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				@foreach($fields as $k => $v)
				<td>
					<strong>{{ $k }}</strong>
				</td>
				@endforeach
				<td>
					<!--strong>Actions</strong-->
					@if(Session::get('role') >= 4)
						<a href="{{ URL::to($route.'/create') }}" class="btn btn-small btn-primary">
							<!-- Nouveau -->
							<span class="glyphicon glyphicon-plus"></span>
						</a>
					@endif
				</td>
			</tr>
		</thead>
		<tbody>

		@foreach($items as $key => $value)
			<tr>
				@foreach($fields as $k => $v)
				<td>
					{{ $value->$v() }}
				</td>
				@endforeach
				<td>
					@if(Session::get('role') >= 5)
						<!-- Administrateur -->
						@include('includes.actions', array('url' => $route.'/'.$value->id, 'readEditDelete' => array(1,1,1)))
					@elseif(Session::get('role') >= 4)
						<!-- Secrétaire pédagogique -->
						@include('includes.actions', array('url' => $route.'/'.$value->id, 'readEditDelete' => array(1,1,0)))
					@elseif(Session::get('role') < 4)
						<!-- Autre -->
						@include('includes.actions', array('url' => $route.'/'.$value->id, 'readEditDelete' => array(1,0,0)))
					@endif
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

</div>

@stop