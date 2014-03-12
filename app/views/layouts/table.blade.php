@extends('layouts.master')
@section('content')

@include('includes.title', array('name' => $name, 'route' => $route))

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
					<a href="{{ URL::to($route.'/create') }}" class="btn btn-small btn-primary">Nouveau</a>
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
					{{ HTML::crud($route.'/'.$value->id, array(1,1,1)) }}
				@elseif(Session::get('role') >= 4)
					<!-- Secrétaire pédagogique -->
					{{ HTML::crud($route.'/'.$value->id, array(1,1,0)) }}
				@elseif(Session::get('role') < 4)
					<!-- Autre -->
					{{ HTML::crud($route.'/'.$value->id, array(1,0,0)) }}
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop