<!DOCTYPE html>
<html>
	<head>
		@include('includes.head')
		{{ HTML::style('css/normalize.css') }}
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/main.css') }}
	</head>
	<body>
		{{ $role = Session::has('role') ? Session::get('role') : 0 }}
		<header>
			@include('includes.header')
		</header>
		<div>
			@yield('content')
		</div>
		<footer>
			@include('includes.footer')
		</footer>
		{{ HTML::script('js/vendor/jquery-1.11.0.min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
		{{ HTML::script('js/main.js') }}
	</body>
</html>