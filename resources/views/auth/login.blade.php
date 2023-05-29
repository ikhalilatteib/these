<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Konteynırlara topluca iş yaptırma paneli">
	<meta name="keywords" content="Docker ile çoklu konteynerlar kullanarak paralel iş yapan sistem tasarımı">
	<meta name="author" content="Themesbox17">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<title>Paralel işlem yapan sistem arayüzü</title>
	<!-- Fevicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<!-- Start css -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
	
	@vite('resources/css/app.css')
	<!-- End css -->
</head>
<body class="vertical-layout">
<!-- Start Containerbar -->
<div id="app"></div>
@vite('resources/js/app.js')


<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/modernizr.min.js')}}"></script>
<script src="{{asset('assets/js/detect.js')}}"></script>
<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>

<!-- End js -->
</body>
</html>