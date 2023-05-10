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
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="assets/css/style.css" rel="stylesheet" type="text/css">
	<!-- End css -->
</head>
<body class="vertical-layout">
<!-- Start Containerbar -->
<div id="containerbar" class="containerbar authenticate-bg">
	<!-- Start Container -->
	<div class="container">
		<div class="auth-box login-box">
			<!-- Start row -->
			<div class="row no-gutters align-items-center justify-content-center">
				<!-- Start col -->
				<div class="col-md-6 col-lg-5">
					<!-- Start Auth Box -->
					<div class="auth-box-right">
						<div class="card">
							<div class="card-body">
								<form action="{{ route('login.in') }}" method="POST">
									@csrf
									<div class="form-head">
										<a href="index.html" class="logo"><img src="assets/images/logo.svg"
										                                       class="img-fluid" alt="logo"></a>
									</div>
									<h4 class="text-primary my-4">Giriş Yap !</h4>
									<div class="form-group">
										<input type="text" name="email"
										       class="form-control @error('email') is-invalid @enderror" id="username"
										       placeholder="Email" required>
										@error('email')
										<div class="invalid-feedback text-left">
											{{$message}}
										</div>
										@enderror
									</div>
									<div class="form-group">
										<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
										       placeholder="Şifre" required>
										@error('password')
										<div class="invalid-feedback">
											{{$message}}
										</div>
										@enderror
									</div>
									<div class="form-row mb-3">
										<div class="col-sm-6">
											<div class="custom-control custom-checkbox text-left">
												<input type="checkbox" name="remember" class="custom-control-input"
												       id="rememberme">
												<label class="custom-control-label font-14" for="rememberme">Beni
													Hatırla</label>
											</div>
										</div>
										{{--										<div class="col-sm-6">--}}
										{{--											<div class="forgot-psw">--}}
										{{--												<a id="forgot-psw" href="user-forgotpsw.html" class="font-14">Şifreni mi Unuttun?</a>--}}
										{{--											</div>--}}
										{{--										</div>--}}
									</div>
									<button type="submit" class="btn btn-success btn-lg btn-block font-18">Giriş Yap
									</button>
								</form>
								{{--								<div class="login-or">--}}
								{{--									<h6 class="text-muted">Veya</h6>--}}
								{{--								</div>--}}
								{{--								<div class="social-login text-center">--}}
								{{--									<button type="submit" class="btn btn-primary rounded-circle font-18"><i class="ri-facebook-line"></i></button>--}}
								{{--									<button type="submit" class="btn btn-danger rounded-circle font-18 ml-2"><i class="ri-google-line"></i></button>--}}
								{{--								</div>--}}
								{{--								<p class="mb-0 mt-3">Bir hesabın yok mu? <a href="user-register.html">Kayıt ol</a></p>--}}
							</div>
						</div>
					</div>
					<!-- End Auth Box -->
				</div>
				<!-- End col -->
			</div>
			<!-- End row -->
		</div>
	</div>
	<!-- End Container -->
</div>
<!-- End Containerbar -->
<!-- Start js -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/detect.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<!-- End js -->
</body>
</html>