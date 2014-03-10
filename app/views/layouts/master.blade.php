<!DOCTYPE html>
<html>
	<head>
		@include('includes.head')
		{{ HTML::style('css/normalize.css') }}
		{{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css') }}
		{{ HTML::style('css/main.css') }}
		{{ HTML::script('js/vendor/modernizr-2.7.1.min.js') }}
	</head>
	<body>
		<header>
			@include('includes.header')
		</header>

		<div id="content">
			@yield('content')
		</div>

		<footer>
				@include('includes.footer')
		</footer>

		{{ HTML::script('js/vendor/jquery-1.11.0.min.js') }}
		{{ HTML::script('js/main.js') }}
	</body>
</html>