<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Konteynırlara topluca iş yaptırma paneli">
	<meta name="keywords" content="Docker ile çoklu konteynerlar kullanarak paralel iş yapan sistem tasarımı">
	<meta name="author" content="Themesbox17">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<title>Paralel işlem yapan sistem arayüzü </title>
	<!-- Fevicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<!-- Start css -->
	<!-- Switchery css -->
	<link href="{{asset('assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
	<!-- Apex css -->
	<link href="{{asset('assets/plugins/apexcharts/apexcharts.css')}}" rel="stylesheet">
	<!-- Slick css -->
	<link href="{{asset('assets/plugins/slick/slick.css')}}" rel="stylesheet">
	<link href="{{asset('assets/plugins/slick/slick-theme.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/flag-icon.min.css')}}" rel="stylesheet" type="text/css">
	
	@yield('style')
	
	<link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
	
	<!-- End css -->
</head>
<body class="vertical-layout">

<!-- Start Containerbar -->
<div id="containerbar">
	<!-- Start Leftbar -->
	<div class="leftbar">
		<!-- Start Sidebar -->
		<div class="sidebar">
			<!-- Start Logobar -->
			<div class="logobar">
				<a href="{{ route('dashboard') }}" class="logo logo-large"><img src="assets/images/logo.svg"
				                                                                class="img-fluid" alt="logo"></a>
				<a href="{{ route('dashboard') }}" class="logo logo-small"><img src="assets/images/small_logo.svg"
				                                                                class="img-fluid" alt="logo"></a>
			</div>
			<!-- End Logobar -->
			<!-- Start Navigationbar -->
			<div class="navigationbar">
				<ul class="vertical-menu">
					<li>
						<a href="{{ route('dashboard') }}">
							<i class="ri-dashboard-line"></i><span>MC</span>
						</a>
					</li>
					<li class="vertical-header p-0"></li>
					<li>
						<a href="javaScript:void(0);">
							<i class="ri-settings-2-line"></i><span>Görevler</span><i class="ri-arrow-right-s-line"></i>
						</a>
						<ul class="vertical-submenu" @class(['in'=>request()->routeIs('tasks.*')])>
							<li @class(['active'=>request()->routeIs('tasks.ping.*')]) ><a
										href="{{ route('tasks.ping.index') }}" @class(['active'=>request()->routeIs('tasks.ping.*')])>Ping</a>
							</li>
							<li><a href="basic-ui-kits-badges.html">Nikto</a></li>
							<li><a href="basic-ui-kits-buttons.html">Theharvester</a></li>
							<li><a href="basic-ui-kits-cards.html">eklenebilir</a></li>
							<li><a href="basic-ui-kits-typography.html">eklenebilir</a></li>
						</ul>
					</li>
					<li>
						<a href="{{ route('users.index') }}" @class(['active'=>request()->routeIs('users.*')])>
							<i class="ri-group-line"></i><span>Kullancılar</span>
						</a>
					</li>
					<li>
						<a href="javaScript:void(0);">
							<i class="ri-file-lock-line"></i><span>Sistem Kayıtları</span>
						</a>
					
					</li>
					
					<li>
						<a href="{{ route('account') }}" @class(['active' => request()->routeIs('account')])>
							<i class="ri-account-circle-line"></i><span>Hesabım</span>
						</a>
					</li>
				</ul>
			</div>
			<!-- End Navigationbar -->
		</div>
		<!-- End Sidebar -->
	</div>
	<!-- End Leftbar -->
	<!-- Start Rightbar -->
	<div class="rightbar">
		<!-- Start Topbar Mobile -->
		<div class="topbar-mobile">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="mobile-logobar">
						<a href="{{ route('dashboard') }}" class="mobile-logo"><img src="assets/images/logo.svg"
						                                                            class="img-fluid" alt="logo"></a>
					</div>
					<div class="mobile-togglebar">
						<ul class="list-inline mb-0">
							<li class="list-inline-item">
								<div class="topbar-toggle-icon">
									<a class="topbar-toggle-hamburger" href="javascript:void(0);">
										<i class="ri-more-fill menu-hamburger-horizontal"></i>
										<i class="ri-more-2-fill menu-hamburger-vertical"></i>
									</a>
								</div>
							</li>
							<li class="list-inline-item">
								<div class="menubar">
									<a class="menu-hamburger" href="javascript:void(0);">
										<i class="ri-menu-2-line menu-hamburger-collapse"></i>
										<i class="ri-close-line menu-hamburger-close"></i>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- Start Topbar -->
		<div class="topbar">
			<!-- Start row -->
			<div class="row align-items-center">
				<!-- Start col -->
				<div class="col-md-12 align-self-center">
					<div class="togglebar">
						<ul class="list-inline mb-0">
							<li class="list-inline-item">
								<div class="menubar">
									<a class="menu-hamburger" href="javascript:void(0);">
										<i class="ri-menu-2-line menu-hamburger-collapse"></i>
										<i class="ri-close-line menu-hamburger-close"></i>
									</a>
								</div>
							</li>
						</ul>
					</div>
					<div class="infobar">
						<ul class="list-inline mb-0">
							<li class="list-inline-item">
								<div class="notifybar">
									<div class="dropdown">
										<a class="dropdown-toggle infobar-icon" href="#" role="button"
										   id="notoficationlink" data-toggle="dropdown" aria-haspopup="true"
										   aria-expanded="false"><i class="ri-notification-line"></i>
											<span class="live-icon"></span></a>
										<div class="dropdown-menu dropdown-menu-right"
										     aria-labelledby="notoficationlink">
											<div class="notification-dropdown-title">
												<h5>Bildirimler<a href="#">Hepsini sil</a></h5>
											</div>
											<ul class="list-unstyled">
												<li class="media dropdown-item">
													<span class="action-icon badge badge-primary"><i
																class="ri-bank-card-2-line"></i></span>
													<div class="media-body">
														<h5 class="action-title">Başarıyla tamamlandı </h5>
														<p><span class="timing">Bugün, 09:05 </span></p>
													</div>
												</li>
												<li class="media dropdown-item">
													<span class="action-icon badge badge-success"><i
																class="ri-file-user-line"></i></span>
													<div class="media-body">
														<h5 class="action-title">Yeni kullanıcı Girişi </h5>
														<p><span class="timing">Dün, 02:30 </span></p>
													</div>
												</li>
												<li class="media dropdown-item">
													<span class="action-icon badge badge-secondary"><i
																class="ri-pencil-line"></i></span>
													<div class="media-body">
														<h5 class="action-title">İşlem Durduruldu</h5>
														<p><span class="timing">5 Oct 2023, 12:10 </span></p>
													</div>
												</li>
											
											</ul>
											<div class="notification-dropdown-footer">
												<h5><a href="#">Hepsini gör</a></h5>
											</div>
										</div>
									</div>
								</div>
							</li>
							
							<li class="list-inline-item">
								<div class="profilebar">
									<div class="dropdown">
										<a class="dropdown-toggle" href="#" role="button" id="profilelink"
										   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
													src="https://ui-avatars.com/api/?name={{urlencode(auth()->user()->name)}}&background=random&size=100"
													class="rounded-circle" alt="profile"><span
													class="live-icon">{{auth()->user()->name}}</span></a>
										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
											<a class="dropdown-item" href="{{ route('account') }}"><i
														class="ri-user-6-line"></i>Profilim</a>
											
											<a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
														class="ri-shut-down-line"></i>Çıkış Yap</a>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- End col -->
			</div>
			<!-- End row -->
		</div>
		<!-- End Topbar -->
		<!-- Start Breadcrumbbar -->
		@yield('breadcrumb')
		
		<!-- End Breadcrumbbar -->
		<!-- Start Contentbar -->
		@yield('content')
		<!-- End Contentbar -->
		<!-- Start Footerbar -->
		
		<!-- End Footerbar -->
	</div>
	<!-- End Rightbar -->
</div>
<!-- End Containerbar -->
<!-- Start js -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/modernizr.min.js')}}"></script>
<script src="{{asset('assets/js/detect.js')}}"></script>
<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('assets/js/vertical-menu.js')}}"></script>
<!-- Switchery js -->
<script src="{{asset('assets/plugins/switchery/switchery.min.js')}}"></script>
<!-- Apex js -->
<script src="{{asset('assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/plugins/apexcharts/irregular-data-series.js')}}"></script>
<!-- Slick js -->
<script src="{{asset('assets/plugins/slick/slick.min.js')}}"></script>

@yield('script')
<!-- Custom Dashboard js -->
<script src="{{asset('assets/js/custom/custom-dashboard.js')}}"></script>
<!-- Core js -->
<script src="{{asset('assets/js/core.js')}}"></script>
<!-- End js -->
</body>
</html>