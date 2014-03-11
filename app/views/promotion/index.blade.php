@extends('layouts.master')
@section('content')

<a href="{{ URL::to('promotions') }}"><h2>Promotions</h2></a>
<a href="{{ URL::to('promotions/create') }}" class="btn btn-small btn-primary">Nouveau</a>

<ul>
	@foreach($promotions as $key => $value)
		<li>
			<h4>{{ $value->libelle }}</h4>

			<p>

				<a class="btn btn-small btn-success" href="{{ URL::to('promotions/' . $value->id) }}">Afficher</a>

				<a class="btn btn-small btn-info" href="{{ URL::to('promotions/' . $value->id . '/edit') }}">Modifier</a>

				{{ Form::open(array('url' => 'promotions/' . $value->id)) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Supprimer', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}

			</p>
		</li>
	@endforeach
</ul>

</div>
@stop