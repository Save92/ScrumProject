<!--
$crud = array(1,1,1,1);
array(
	'items' => $exemples,
	'name' => 'Exemples',
	'route' => 'exemples',
	'actions' => $crud
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
					{{ $k }}
				</td>
				@endforeach
				<td>
					<div class="pull-right">
					{{-- create --}}
					@if($actions[0] == true)
						<a href="{{ URL::to($route.'/create') }}" class="btn btn-small btn-primary">
							<span class="glyphicon glyphicon-plus"></span>
						</a>
					@endif
					</div>
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
					{{-- (c)rud --}}
					@include('includes.actions', array('url' => $route.'/'.$value->id, 'crud' => $actions))
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

</div>

@stop