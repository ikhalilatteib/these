@extends('layouts.master')
@section('breadcrumb')
	<div class="breadcrumbbar">
		<div class="row align-items-center">
			<div class="col-md-8 col-lg-8">
				<div class="media">
					<span class="breadcrumb-icon"><i class="ri-dashboard-line"></i></span>
					<div class="media-body">
						<h4 class="page-title">Kullanıcı Detayı</h4>
						<div class="breadcrumb-list">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('users.index') }}">MC</a></li>
								<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Kullanıcılar</a></li>
								<li class="breadcrumb-item active" aria-current="page">Kullanıcı Detayı</li>
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
				
					<div class="card-body">
						<p><strong>Ad ve Soyad:</strong> {{ $user->name }}</p>
						<p><strong>Email:</strong> {{ $user->email }}</p>
						<a href="{{ route('users.index') }}" class="btn btn-primary">Geri dön</a>
						<form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Sil</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
