@extends('layouts.master')
@section('content')

@include('includes.title', array('name' => $name, 'route' => $route))

{{ HTML::ul($errors->all()) }}

	@foreach($items as $key => $value)
		<form method="POST" action="{{ URL::to($key) }}" role="form" class="form-horizontal">
		@foreach($value as $input)

			<div class="form-group">
				<label for="{{ $input[0] }}" class="col-sm-2 control-label">{{ $input[1] }}</label>
				<div class="col-sm-10">
					@if($input[2] == 'select' && isset($input[3]))
						<select name="{{ $input[0] }}" id="{{ $input[0] }}" class="form-control">
						@foreach($input[3] as $i)
							<option value="{{ $i->id }}">{{ $i->libelle ? $i->libelle : $i->getName() }}</option>
						@endforeach
						</select>
					@else
						<input type="{{ $input[2] }}" name="{{ $input[0] }}" id="{{ $input[0] }}" class="form-control">
					@endif
				</div>
			</div>

		@endforeach
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<a href="{{ URL::to($key) }}">
					<button type="button" class="btn btn-primary">
					<span class="glyphicon glyphicon-chevron-left"></span>
					</button>
				</a>
				<input type="submit" class="btn btn-primary" value="Ajouter">
			</div>
		</div>
		</form>
	@endforeach

@stop