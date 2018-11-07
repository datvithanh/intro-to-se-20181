<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="/assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Qlo</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/paper-kit.css" rel="stylesheet"/>
    <link href="/assets/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet">
    <link href="/assets/css/dp.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">


</head>
<body class="blog-page">
<!--         default navbar with notifications     -->
	<nav class="navbar navbar-toggleable-md fixed-top bg-danger navbar-transparent" color-on-scroll="200">
		<div class="container">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-bar"></span>
				<span class="navbar-toggler-bar"></span>
				<span class="navbar-toggler-bar"></span>
			</button>
			<!-- <a class="navbar-brand" href="/presentation.html">Paper Kit 2 Pro</a> -->
			<img class="logo img-responsive" src="https://demo.qloapps.com/img/logo.jpg" alt="Qloapps Demo" width="243" height="61" />
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="/index.html" data-scroll="true" href="javascript:void(0)">Components</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-round btn-danger" href="https://www.creative-tim.com/product/paper-kit-2-pro"><i class="fa fa-shopping-cart"></i></a>
					</li>
				</ul>
			</div>
		</div>
    </nav>
    @yield('content')
    <footer>
    </footer>
</body>

<!-- Core JS Files -->
<script src="/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="/assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
<script src="/assets/js/tether.min.js" type="text/javascript"></script>
<script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/js/paper-kit.js?v=2.0.0"></script>
<script src="/assets/js/hotel-datepicker.min.js"></script>
<script src="/assets/js/fecha.min.js"></script>
@stack('scripts')

</html>
