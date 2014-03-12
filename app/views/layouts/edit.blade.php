@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}
	@foreach($items as $key => $value)
		<form method="POST" action="{{ URL::to($key) . $item->id }}" role="form" class="form-horizontal">
			<input name="_method" type="hidden" value="PUT">
		@foreach($value as $input)

			<div class="form-group">
				<label for="{{ $input[0] }}" class="col-sm-2 control-label">{{ $input[1] }}</label>
				<div class="col-sm-10">
					@if($input[2] == 'select' && isset($input[3]))
						<select name="{{ $input[0] }}" id="{{ $input[0] }}" class="form-control">
						@foreach($input[3] as $i)
							<?php
								if ($input[4] == $i->id) {
									$selected = 'selected = "selected"';
								} else {
									$selected = '';
								}
							?>
							<option value="{{ $i->id }}" {{ $selected }}>{{ $i->libelle ? $i->libelle : $i->getName() }}</option>
						@endforeach
						</select>
					@else
						<input type="{{ $input[2] }}" name="{{ $input[0] }}" id="{{ $input[0] }}" class="form-control" value="{{ $input[0] == 'password' ? '' : $item->$input[0] }}">
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
				<input type="submit" class="btn btn-primary" value="Mettre à jour">
			</div>
		</div>
		</form>
	@endforeach

@stop