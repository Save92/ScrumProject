@extends('layouts.master')
@section('content')

<a href="{{ URL::to('classes') }}"><h2>Classes</h2></a>
<a href="{{ URL::to('classes/create') }}" class="btn btn-small btn-primary">Nouveau</a>

<ul>
	@foreach($classes as $key => $value)
		<li>
			<h4>{{ $value->libelle }}</h4>

			<p>

				<a class="btn btn-small btn-success" href="{{ URL::to('classes/' . $value->id) }}">Afficher</a>

				<a class="btn btn-small btn-info" href="{{ URL::to('classes/' . $value->id . '/edit') }}">Modifier</a>

				{{ Form::open(array('url' => 'classes/' . $value->id)) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Supprimer', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}

			</p>
		</li>
	@endforeach
</ul>

</div>
@stop