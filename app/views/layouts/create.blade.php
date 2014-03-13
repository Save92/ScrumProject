<!--
array(
	'name' => 'Exemples',
	'route' => 'exemples',
	'items' => array(
		array('exemple', 'Exemple', 'text'),
		array('id_example', 'Ecampe', 'select', $examples)
	)
)
-->

@extends('layouts.master')
@section('content')

<div class="panel panel-default">

	<div class="panel-heading">
		@include('includes.title', array('name' => $name, 'route' => $route))
	</div>

	<div class="panel-body">
	{{ HTML::ul($errors->all()) }}

		<form method="POST" action="{{ URL::to($route) }}" role="form" class="form-horizontal">

		@foreach($items as $value)
			<div class="form-group">
				<label for="{{ $value[0] }}" class="col-sm-2 control-label">{{ $value[1] }}</label>
				<div class="col-sm-10">
					@if($value[2] == 'select' && isset($value[3]))
						@if(is_array($value[3]))
							<select name="{{ $value[0] }}" id="{{ $value[0] }}" class="form-control">
								@foreach($value[3] as $k => $v)
									<option value="{{ $k }}">{{ $v }}</option>
								@endforeach
							</select>
						@else
							@if(count($value[3]) == 0)
								Aucune entrée
							@else
								<select name="{{ $value[0] }}" id="{{ $value[0] }}" class="form-control">
								@foreach($value[3] as $i)
									<option value="{{ $i->id }}">{{ $i->libelle ? $i->libelle : $i->getName() }}</option>
								@endforeach
								</select>
							@endif
						@endif
					@elseif(!isset($value[3]))
						<input type="{{ $value[2] }}" name="{{ $value[0] }}" id="{{ $value[0] }}" class="form-control">
					@elseif($value[2] = 'text' && isset($value[3]))
						<input type="{{ $value[2] }}" name="{{ $value[0] }}" id="{{ $value[0] }}" class="form-control" value="{{ $value[3] }}" readonly="readonly">
					@else
						{{ $value[0] == 'password' ? '' : $item->$value[0] }}
					@endif
				</div>
			</div>
		@endforeach

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">

				<a href="{{ URL::to($route) }}">
					<button type="button" class="btn btn-default">
						Annuler
					</button>
				</a>

				<input type="submit" class="btn btn-primary" value="Ajouter">

			</div>
		</div>
		</form>

	</div>

</div>

@stop