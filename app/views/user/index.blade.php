@extends('layouts.master')
@section('content')

<a href="{{ URL::to('users') }}"><h2>Utilisateurs</h2></a>

@if(Session::get('role') >= 4)
	<a href="{{ URL::to('users/create') }}" class="btn btn-small btn-primary">Nouveau</a>
@endif

<table class="table table-striped">
	<thead>
		<tr>
			<td>
				<strong>Nom</strong>
			</td>
			<td>
				<strong>Role</strong>
			</td>
			<td>
				<strong>Mail</strong>
			</td>
			<td>
				<strong>Téléphone</strong>
			</td>
			<td>
				<strong>Actions</strong>
			</td>
		</tr>
	</thead>
	<tbody>
	@foreach($users as $key => $value)
		<tr>
			<td>
				<!--a href="{{ URL::to('users/' . $value->id) }}"></a-->
				{{ $value->getName() }}
			</td>
			<td>
				{{ $value->getRole() }}
			</td>
			<td>
				{{ $value->mail }}
			</td>
			<td>
				{{ $value->telephone }}
			</td>
			<td>
				@if(Session::get('role') >= 5)
					<!-- Administrateur -->
					{{ HTML::crud('users/'.$value->id, array(1,1,1)) }}
				@elseif(Session::get('role') >= 4)
					<!-- Secrétaire pédagogique -->
					{{ HTML::crud('users/'.$value->id, array(1,1,0)) }}
				@elseif(Session::get('role') < 4)
					<!-- Autre -->
					{{ HTML::crud('users/'.$value->id, array(1,0,0)) }}
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop