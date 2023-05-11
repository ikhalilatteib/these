@extends('layouts.master')
@section('breadcrumb')
	<div class="breadcrumbbar">
		<div class="row align-items-center">
			<div class="col-md-8 col-lg-8">
				<div class="media">
					<span class="breadcrumb-icon"><i class="ri-terminal-line"></i></span>
					<div class="media-body">
						<h4 class="page-title">Ping</h4>
						<div class="breadcrumb-list">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">MC</a></li>
								<li class="breadcrumb-item"><a href="javascript:void(0);">Görevler</a></li>
								<li class="breadcrumb-item active" aria-current="page">Ping</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="widgetbar">
					<a href="{{ route('tasks.ping.create') }}" class="btn btn-primary"><i
								class="ri-add-line align-middle mr-2"></i>Yeni Ping</a>
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
					<div class="card-header bg-primary text-white">Ping</div>
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
									<th>#</th>
									<th>Başlık</th>
									<th>Konteyner</th>
									<th>Oluşturan</th>
									<th>Durum</th>
									<th>Tarih</th>
									<th class="text-center">Detay</th>
								</tr>
								</thead>
								<tbody>
								@foreach($pings as $ping)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $ping->title }}</td>
										<td>{{ $ping->container }}</td>
										<td>{{ $ping->user->name }}</td>
										<td>{!! \App\Enums\TaskStatusEnum::from($ping->status)->taskStatusBadge() !!}</td>
										<td>{{ $ping->created_at->format('d.m.Y') }}</td>
										<td class="text-center">
											<a href="{{ route('tasks.ping.show', $ping) }}"
											   class="btn btn-primary-rgba btn-sm"><i class="ri-eye-line"></i></a>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
						
						{{ $pings->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
