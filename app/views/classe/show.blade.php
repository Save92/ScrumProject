@extends('layouts.master')
@section('content')

	<h1>{{ $classe->libelle }}</h1>
	<p>
		{{ Form::label('user', 'Secrétaire pédagogique', array('class' => 'control-label')) }}
		{{ User::find($classe->id_user)->getName() }}
	</p>

	<p>
		Elèves

		<div class="col-sm-4">
			<ul class="list-group">
				
				<li class="list-group-item">test</li>
			</ul>
		</div>
	</p>
@stop