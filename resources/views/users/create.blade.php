@extends('layouts.master')
@section('breadcrumb')
	<div class="breadcrumbbar">
		<div class="row align-items-center">
			<div class="col-md-8 col-lg-8">
				<div class="media">
					<span class="breadcrumb-icon"><i class="ri-dashboard-line"></i></span>
					<div class="media-body">
						<h4 class="page-title">Kullanıcı Ekle</h4>
						<div class="breadcrumb-list">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">MC</a></li>
								<li class="breadcrumb-item"><a href="{{route('users.index')}}">Kullanıclar</a></li>
								<li class="breadcrumb-item active" aria-current="page">Kullanıcı Ekle</li>
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
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">Kullanıcı Ekle
					</div>
					
					<div class="card-body">
						<form action="{{ route('users.store') }}" method="POST">
							@csrf
							<div class="form-group">
								<label for="name">Ad ve Soyad</label>
								<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
								@error('name')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							
							<div class="form-group">
								<label for="email">Posta Adresi</label>
								<input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
								@error('email')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							
							<div class="form-group">
								<label for="password">Şifre</label>
								<input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
								@error('password')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							
							<div class="form-group">
								<label for="password_confirmation">Şifreyi Tekrarla</label>
								<input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
								@error('password_confirmation')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							
							<button type="submit" class="btn btn-primary btn-lg btn-block">Ekle</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
