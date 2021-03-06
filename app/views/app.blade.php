<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{asset('/css/app.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('/css/jquery-ui.css')}}">
  	<script src="{{asset('/css/jquery-1.10.2.js')}}"></script>
  	<script src="{{asset('/css/jquery-ui.js')}}"></script>
  	<link rel="stylesheet" href="{{asset('/css/style.css')}}">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	@yield('script')
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{URL::to('/login')}}">Login</a></li>
						<li><a href="{{URL::to('/register')}}">Register</a></li>
					@else
						<li>
							<a>{{ Auth::user()->email }}</a>
						</li>
						<li>
							<a href="{{URL::to('/deleteImage')}}">Album de Foto</a>
						</li>
						<li>
							<a href="{{URL::to('/')}}">Editar Datos</a>
						</li>
						<li>
							<a href="{{URL::to('/logout')}}">Logout</a>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

</body>
</html>
