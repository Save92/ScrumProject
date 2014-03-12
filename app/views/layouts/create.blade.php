@extends('layouts.master')
@section('content')

	{{ HTML::ul($errors->all()) }}
	@foreach($items as $key => $value)
		{{ Form::open(array('url' => $key, 'class' => 'form-horizontal', 'role' => 'form')) }}
		@foreach($value as $input => $label)
			<div class="form-group">
				{{ Form::label($input, $label, array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text($input, null, array('class' => 'form-control')) }}
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
				{{ Form::submit('Ajouter', array('class' => 'btn btn-primary')); }}
			</div>
		</div>
		{{ Form::close() }}
	@endforeach

@stop