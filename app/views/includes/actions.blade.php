<?php
$url = URL::to($url);
?>

@if($readEditDelete[0] == true)
	<a class="btn btn-default" href="{{ $url }}"><span class="glyphicon glyphicon-search"></span></a><!-- Afficher -->
@endif
@if($readEditDelete[1] == true)
	<a class="btn btn-primary" href="{{ $url }}/edit"><span class="glyphicon glyphicon-pencil"></span></a><!-- Modifier -->
@endif
@if($readEditDelete[2] == true)
	<form method="POST" action="{{ $url }}" class="delete">
		<input name="_method" type="hidden" value="DELETE">
		<button type="submit" class="btn btn-danger">
			<span class='glyphicon glyphicon-trash'></span><!-- Supprimer -->
		</button>
	</form>
@endif