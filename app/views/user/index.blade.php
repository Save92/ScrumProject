@extends('layouts.master')
@section('content')

<a href="{{ URL::to('users') }}"><h2>Utilisateurs</h2></a>
<a href="{{ URL::to('users/create') }}" class="btn btn-small btn-primary">Nouveau</a>

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
				<a href="{{ URL::to('users/' . $value->id) }}">
					{{ $value->getName() }}
				</a>
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
				{{ HTML::crud('users/'.$value->id) }}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop