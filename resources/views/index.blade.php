@section('breadcrumb')
	<div class="breadcrumbbar">
		<div class="row align-items-center">
			<div class="col-md-8 col-lg-8">
				<div class="media">
					<span class="breadcrumb-icon"><i class="ri-user-6-fill"></i></span>
					<div class="media-body">
						<h4 class="page-title">PİYS</h4>
						<div class="breadcrumb-list">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Ana Sayfa</a></li>
								<li class="breadcrumb-item"><a href="#">Kontrol Paneli</a></li>
								<li class="breadcrumb-item active" aria-current="page">PİYS</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="widgetbar">
					<button class="btn btn-primary"><i class="ri-add-line align-middle mr-2"></i>Ekle</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('content')
	<div class="contentbar">
		<!-- Start row -->
		<div class="row">
			<!-- Start col -->
			<div class="col-lg-12 col-xl-4">
				<div class="card m-b-30">
					<div class="card-header">
						<h5 class="card-title mb-0">Başarılı İşlemler</h5>
					</div>
					<div class="card-body pb-0">
						<div class="row align-items-center">
							<div class="col-6">
								<h4>125</h4>
							</div>
							<div class="col-6 text-right">
								<p class="mb-0"><i class="ri-arrow-right-up-line text-success align-middle font-18 mr-1"></i>5%</p>
								<p class="mb-0">Bu Hafta</p>
							</div>
						</div>
						<div id="apex-line-chart1"></div>
					</div>
				</div>
			</div>
			<!-- End col -->
			<!-- Start col -->
			<div class="col-lg-12 col-xl-4">
				<div class="card m-b-30">
					<div class="card-header">
						<h5 class="card-title mb-0">Ypılan Tüm İşlemler</h5>
					</div>
					<div class="card-body pb-0">
						<div class="row align-items-center">
							<div class="col-6">
								<h4>1,345</h4>
							</div>
							<div class="col-6 text-right">
								<p class="mb-0"><i class="ri-arrow-right-down-line text-danger align-middle font-18 mr-1"></i>15%</p>
								<p class="mb-0">Bu Hafta</p>
							</div>
						</div>
						<div id="apex-line-chart2"></div>
					</div>
				</div>
			</div>
			<!-- End col -->
			<!-- Start col -->
			<div class="col-lg-12 col-xl-4">
				<div class="card m-b-30">
					<div class="card-header">
						<h5 class="card-title mb-0">Başarısız İşlemler</h5>
					</div>
					<div class="card-body pb-0">
						<div class="row align-items-center">
							<div class="col-6">
								<h4>57</h4>
							</div>
							<div class="col-6 text-right">
								<p class="mb-0"><i class="ri-arrow-right-up-line text-success align-middle font-18 mr-1"></i>45%</p>
								<p class="mb-0">Bu Hafta</p>
							</div>
						</div>
						<div id="apex-line-chart3"></div>
					</div>
				</div>
			</div>
			<!-- End col -->
		</div>
		<!-- End row -->
		<!-- Start row -->
		<!--  <div class="row">
		   İşlem durumunu gösterebiliriz bu şekilde
		   <div class="col-lg-12 col-xl-4">
			   <div class="card m-b-30">
				   <div class="card-header text-center">
					   <h5 class="card-title mb-0">İşlem Durumu </h5>
				   </div>
				   <div class="card-body p-0">
					   <div id="apex-circle-chart"></div>
				   </div>
			   </div>
		   </div>
	   </div>-->
		<!-- Start row -->
		<div class="row">
			<!-- Start col -->
			<div class="col-lg-12 col-xl-6">
				<div class="card m-b-30">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-6 col-lg-9">
								<h5 class="card-title mb-0">En Son Tamamlanan Projeler</h5>
							</div>
							<div class="col-6 col-lg-3">
								<select class="form-control font-12">
									<option value="class1" selected>Jan 23</option>
									<option value="class2">Feb 23</option>
									<option value="class3">Mar 23</option>
									<option value="class4">Apr 23</option>
									<option value="class5">May 23</option>
								</select>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Proje Sahibi</th>
									<th scope="col">Durum</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<th scope="row">1</th>
									<td>Aleyna ÇELİK</td>
									<td><span class="badge badge-primary">Başarılı </span></td>
								</tr>
								<tr>
									<th scope="row">2</th>
									<td>Ibrahim Khalil </td>
									<td><span class="badge badge-success">Bşarılı </span></td>
								</tr>
								
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- End col -->
			<!-- Start col -->
			<div class="col-lg-12 col-xl-3">
				<div class="card m-b-30">
					<div class="card-header text-center">
						<h5 class="card-title mb-0">Kullanıcılar Listesi</h5>
					</div>
					<div class="card-body">
						<div class="user-slider">
							<div class="user-slider-item">
								<div class="card-body text-center">
									<span class="action-icon badge badge-primary-inverse">AÇ</span>
									<h5>Aleyna ÇELİK</h5>
									<p>Ankara</p>
									<p class="mt-3 mb-0"><span class="badge badge-primary font-weight-normal font-14 py-1 px-2">Designer</span></p>
								</div>
							</div>
							<div class="user-slider-item">
								<div class="card-body text-center">
									<span class="action-icon badge badge-success-inverse">İK</span>
									<h5>Ibrahim Khalil</h5>
									<p>Bilecik</p>
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</div>
			<!-- End col -->
			<!-- Start col -->
			<div class="col-lg-12 col-xl-3">
				<div class="card bg-secondary-rgba text-center m-b-30">
					<div class="card-header">
						<h5 class="card-title mb-0">Hedefe Ulaşanlar</h5>
					</div>
					<div class="card-body">
						<img src="assets/images/general/winner.svg" class="img-fluid img-winner" alt="achievements">
						<h5 class="my-0"></h5>
					</div>
				</div>
			</div>
			<!-- End col -->
		</div>
		<!-- End row -->
	</div>
@endsection