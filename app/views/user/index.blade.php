@extends('layouts.master')
@section('content')

<a href="{{ URL::to('users') }}"><h2>Utilisateurs</h2></a>
<a href="{{ URL::to('users/create') }}" class="btn btn-small btn-primary">Nouveau</a>

<ul>
	@foreach($users as $key => $value)
		<li>
			{{ HTML::show_user($value, false) }}
		</li>
	@endforeach
</ul>

</div>
@stop