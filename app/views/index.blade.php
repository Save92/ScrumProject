@extends('layouts.master')
@section('content')

<p>Hello World</p>

<p>
	Créer une bdd 'intranet' (app/config/database.php) et aller sur ce lien :
	<a href="{{ URL::to('db') }}">/db</a><br/>
	Email: admin / Password: admin
</p>

@stop