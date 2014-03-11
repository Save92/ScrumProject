@extends('layouts.master')
@section('content')

<p>Hello World</p>

<p>
	Créer une bdd 'intranet' (app/config/database.php) et aller sur ce lien :
	<a href="{{ URL::to('db') }}">/db</a><br/>
	Email: a@a.a / Password: a
</p>

@stop