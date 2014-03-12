<a href="{{ URL::to($route) }}"><h2>{{ $name }}</h2></a>

@if(Session::get('role') >= 4)
	<!--a href="{{ URL::to($route.'/create') }}" class="btn btn-small btn-primary">Nouveau</a-->
@endif