<!--
array(
	'name' => 'Exemples',
	'route' => 'exemples',
	'item' => $exemple,
	'items' => array(
		array('exemple', 'Exemple', 'text'),
		array('id_example', 'Example', 'select', $examples, $exemple->id_example)
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

		<form method="POST" action="{{ URL::to($route) . '/' . $item->id }}" role="form" class="form-horizontal">
			<input name="_method" type="hidden" value="PUT">

			@foreach($items as $value)
			<div class="form-group">
				<label for="{{ $value[0] }}" class="col-sm-2 control-label">{{ $value[1] }}</label>
				<div class="col-sm-10">
					@if($value[2] == 'select' && isset($value[3]) && $value[4] !== false && !isset($value[5]))
						<select name="{{ $value[0] }}" id="{{ $value[0] }}" class="form-control">
							@foreach($value[3] as $i)
								<?php
									if ($value[4] == $i->id) {
										$selected = 'selected = "selected"';
									} else {
										$selected = '';
									}
								?>
							<option value="{{ $i->id }}" {{ $selected }}>{{ $i->libelle ? $i->libelle : $i->getName() }}</option>
							@endforeach
						</select>
					@elseif(!isset($value[3]))
						<input type="{{ $value[2] }}" name="{{ $value[0] }}" id="{{ $value[0] }}" class="form-control" value="{{ $value[0] == 'password' ? '' : $item->$value[0] }}">


					@elseif(isset($value[5]) && 'readonly' == $value[2] && false == $value[5] )
						<div class="form-control">

							{{ $value[3]->find($value[4])->getName() ? $value[3]->find($value[4])->getName() : $value[4] }}
							<input type="hidden" name="{{ $value[0] }}" id="{{ $value[0] }}" class="form-control" value="{{ $value[4] }}">
						</div>
					@else
						<div class="form-control">
							{{-- $value[0] == 'password' ? '' : $item->$value[0] --}}
							{{ $value[0] == 'password' ? '' : $item->$value[0] }}
							<input type="hidden" name="{{ $value[0] }}" id="{{ $value[0] }}" value="{{ $value[0] == 'password' ? '' : $item->$value[0] }}">
						</div>
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

					<input type="submit" class="btn btn-primary" value="Mettre à jour">
				</div>
			</div>
		</form>

	</div>

</div>

@stop