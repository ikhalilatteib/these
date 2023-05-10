@extends('layouts.master')
@section('breadcrumb')
	<div class="breadcrumbbar">
		<div class="row align-items-center">
			<div class="col-md-8 col-lg-8">
				<div class="media">
					<span class="breadcrumb-icon"><i class="ri-dashboard-line"></i></span>
					<div class="media-body">
						<h4 class="page-title">Kulllancılar</h4>
						<div class="breadcrumb-list">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">MC</a></li>
								<li class="breadcrumb-item active" aria-current="page">Kullanıcılar</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="widgetbar">
					<a href="{{ route('users.create') }}" class="btn btn-primary"><i
								class="ri-add-line align-middle mr-2"></i>Ekle</a>
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
					<div class="card-header bg-primary text-white">Kullanıclar</div>
					@if(session('success'))
						<div class="alert alert-success m-2" role="alert">
							{{session('success')}}
						</div>
					@endif
					@if(session('warning'))
						<div class="alert alert-warning m-2" role="alert">
							{{session('warning')}}
						</div>
					@endif
					@if(session('danger'))
						<div class="alert alert-danger m-2" role="alert">
							{{session('danger')}}
						</div>
					@endif
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
								<tr>
									<th>ID</th>
									<th>Ad ve Soyad</th>
									<th>Email</th>
									<th class="text-center">İşlem</th>
								</tr>
								</thead>
								<tbody>
								@foreach($users as $user)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td class="text-center">
											<a href="{{ route('users.show', $user) }}"
											   class="btn btn-primary-rgba btn-sm"><i class="ri-eye-line"></i></a>
											<a href="{{ route('users.edit', $user) }}"
											   class="btn btn-warning-rgba btn-sm"><i class="ri-pencil-line"></i></a>
											<form action="{{ route('users.destroy', $user) }}" method="POST"
											      class="d-inline">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger-rgba btn-sm"
												        onclick="return confirm('Are you sure you want to delete this user?')">
													<i class="ri-close-line"></i></button>
											</form>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						
						{{ $users->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
