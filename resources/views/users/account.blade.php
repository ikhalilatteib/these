@extends('layouts.master')
@section('breadcrumb')
	<div class="breadcrumbbar">
		<div class="row align-items-center">
			<div class="col-md-8 col-lg-8">
				<div class="media">
					<span class="breadcrumb-icon"><i class="ri-user-line"></i></span>
					<div class="media-body">
						<h4 class="page-title">My Account</h4>
						<div class="breadcrumb-list">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">MC</a></li>
								<li class="breadcrumb-item active" aria-current="page">Hesabım</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="widgetbar">
				</div>
			</div>
		</div>
	</div>
@endsection
@section('content')
	<div class="contentbar">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">Hesab Bilgilerim</div>
					
					<div class="card-body">
						<form action="{{ route('update.info') }}" method="POST">
							@csrf
							@method('PUT')
							
							<div class="form-group">
								<label for="name">Ad ve Soyad</label>
								<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}" required>
								@error('name')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}" required>
								@error('email')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							
							<button type="submit" class="btn btn-primary">Güncelle</button>
						</form>
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">Şifreyi Güncelle</div>
					
					<div class="card-body">
						<form action="{{ route('update.password') }}" method="POST">
							@csrf
							@method('PUT')
							
							<div class="form-group">
								<label for="current_password">Şimdiki Şifre</label>
								<input type="password" name="current_password" id="current_password" class="form-control" required>
							</div>
							
							<div class="form-group">
								<label for="password">Yeni Şifre</label>
								<input type="password" name="password" id="password" class="form-control" required>
							</div>
							
							
							<button type="submit" class="btn btn-primary">Güncelle</button>
						</form>
					</div>
				</div>
			</div>
			
				<div class="col-md-12">
					<div class="card m-t-30">
						<div class="card-header bg-primary text-white"> Loglarım</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead>
									<tr>
										<th>#</th>
										<th>IP</th>
										<th>İslem</th>
										<th>Tarih</th>
										<th>Saat</th>
									</tr>
									</thead>
									<tbody>
									@foreach($logs as $log)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $log->ip }}</td>
											<td>{{ $log->action }}</td>
											<td>
												{{ $log->created_at->format("d/m/Y") }}
											</td>
											<td>
												{{ $log->created_at->format("H:i:s") }}
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
							
							{{ $logs->links() }}
						</div>
					</div>
				</div>
		</div>
	</div>
@endsection
