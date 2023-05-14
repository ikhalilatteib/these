@extends('layouts.master')
@section('breadcrumb')
	<div class="breadcrumbbar">
		<div class="row align-items-center">
			<div class="col-md-8 col-lg-8">
				<div class="media">
					<span class="breadcrumb-icon"><i class="ri-dashboard-line"></i></span>
					<div class="media-body">
						<h4 class="page-title">Kullanıcı Logları</h4>
						<div class="breadcrumb-list">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">MC</a></li>
								<li class="breadcrumb-item active" aria-current="page">Kullanıcı Logları</li>
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
					<div class="card-header bg-primary text-white">Kullanıcı Logları</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
								<tr>
									<th>#</th>
									<th>Kullanıcı</th>
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
										<td>{{ $log->user->name }}</td>
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
