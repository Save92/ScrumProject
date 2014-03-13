@extends('layouts.master')
@section('content')

<p class="well well-lg">
	<strong>Ad Min</strong><br/>
	Email <strong>a@a.a</strong><br/>
	Password <strong>a</strong>
</p>

<p class="well">

	Controllers à modifier :
	<br/>
	<span class="glyphicon glyphicon-ok"></span> Utilisateurs
	<br/>
	<span class="glyphicon glyphicon-ok"></span> Formations
	<br/>
	<span class="glyphicon glyphicon-remove"></span> Matières
	<br/>
	<span class="glyphicon glyphicon-remove"></span> Classe
	<br/>
	<span class="glyphicon glyphicon-remove"></span> Diplome
	<br/>
	<span class="glyphicon glyphicon-question-sign"></span> ...

</p>

<p class="well">
	Gestion des permissions :
	<br/>
	Switch case sur les routes <code>app/filters.php</code>
	<br/>
	Switch case dans les controllers : Create Read Update Delete <code>$actions = array(1,1,1,1)</code>
	<br/>
	Navigation <code>app/views/includes/header.blade.php</code>
	<br />
	Mettre à jour la table <code>users</code> lors de l'ajout d'un candidat : passer <code>id_role</code> à 2
</p>

@stop