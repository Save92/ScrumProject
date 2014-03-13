<!DOCTYPE html>
<html>
	<head>
		@include('includes.head')
		{{ HTML::style('css/normalize.css') }}
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/main.css') }}
	</head>
	<body>
		<header>
			@include('includes.header')
		</header>
		<section class="container-fluid panel panel-default">
			@yield('content')
		</section>
		<footer>
			@include('includes.footer')
		</footer>
		{{ HTML::script('js/vendor/jquery-1.11.0.min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
		{{ HTML::script('js/main.js') }}
	</body>
</html>