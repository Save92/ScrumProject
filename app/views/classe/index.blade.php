@extends('layouts.master')
@section('content')

@include('includes.title', array('name' => 'Classes', 'route' => 'classes'))

<ul>
	@foreach($classes as $key => $value)
		<li>
			<h4>{{ $value->libelle }}</h4>

			<p>

				<a class="btn btn-small btn-success" href="{{ URL::to('classes/' . $value->id) }}">Afficher</a>

				<a class="btn btn-small btn-info" href="{{ URL::to('classes/' . $value->id . '/edit') }}">Modifier</a>
				{{ Form::open(array('url' => 'classes/' . $value->id)) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
				{{ Form::close() }}

			</p>
		</li>
	@endforeach
</ul>

</div>
@stop