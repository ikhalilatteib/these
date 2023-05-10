@extends('layouts.master')

@section('breadcrumb')
	<div class="breadcrumbbar">
		<div class="row align-items-center">
			<div class="col-md-8 col-lg-8">
				<div class="media">
					<span class="breadcrumb-icon"><i class="ri-dashboard-line"></i></span>
					<div class="media-body">
						<h4 class="page-title">Edit User</h4>
						<div class="breadcrumb-list">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">MC</a></li>
								<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Kullanıcılar</a></li>
								<li class="breadcrumb-item active" aria-current="page">Kullanıcı Güncelle</li>
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
					<div class="card-header">Kullanıcı Güncelle</div>
					
					<div class="card-body">
						<form action="{{ route('users.update', $user) }}" method="POST">
							@csrf
							@method('PUT')
							<div class="form-group row">
								<label for="name" class="col-md-3 col-form-label ">{{ __('Ad ve Soyad') }}</label>
								
								<div class="col-md-8">
									<input id="name" type="text"
									       class="form-control @error('name') is-invalid @enderror" name="name"
									       value="{{ old('name', $user->name) }}" required autocomplete="name"
									       autofocus>
									
									@error('name')
									<span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="email"
								       class="col-md-3 col-form-label ">{{ __('E-Mail Adresi') }}</label>
								
								<div class="col-md-8">
									<input id="email" type="email"
									       class="form-control @error('email') is-invalid @enderror" name="email"
									       value="{{ old('email', $user->email) }}" required autocomplete="email">
									
									@error('email')
									<span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="password"
								       class="col-md-3 col-form-label ">{{ __('Şifre') }}</label>
								
								<div class="col-md-8">
									<input id="password" type="password"
									       class="form-control @error('password') is-invalid @enderror" name="password"
									       autocomplete="new-password">
									
									@error('password')
									<span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="password_confirmation"
								       class="col-md-3 col-form-label ">{{ __('Şifreyi Tekrarla') }}</label>
								<div class="col-md-8">
									<input id="password_confirmation" type="password"
									       class="form-control @error('password') is-invalid @enderror"
									       name="password_confirmation" autocomplete="new-password">
									@error('password')
									<span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
								</div>
							</div>
							<div class="form-group row text-center">
								<div class="col-md-12">
									<a href="{{ route('users.index') }}" class="btn btn-primary btn-lg">Geri dön</a>
									<button type="submit" class="btn btn-danger btn-lg">Güncelle</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
