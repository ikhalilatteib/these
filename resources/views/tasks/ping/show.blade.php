@extends('layouts.master')
@section('style')
	
	<style>
        .terminal {
            display: flex;
            flex-direction: column;
            height: 300px;
            padding: 10px;
            background-color: #000;
            color: #fff;
            font-family: monospace;
            font-size: 14px;
        }

        .terminal-output {
            flex: 1;
            overflow-y: scroll;
            padding-right: 20px;
        }
	</style>
@endsection
@section('breadcrumb')
	<div class="breadcrumbbar">
		<div class="row align-items-center">
			<div class="col-md-8 col-lg-8">
				<div class="media">
					<span class="breadcrumb-icon"><i class="ri-terminal-line"></i></span>
					<div class="media-body">
						<h4 class="page-title">Detay</h4>
						<div class="breadcrumb-list">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">MC</a></li>
								<li class="breadcrumb-item"><a href="javascript:void(0);">Görevler</a></li>
								<li class="breadcrumb-item"><a href="{{ route('tasks.ping.index') }}">Ping</a></li>
								<li class="breadcrumb-item active" aria-current="page">Detay</li>
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
				<div class="card m-b-30">
					<div class="card-header">
						<h5 class="card-title">Stacked Area Chart</h5>
					</div>
					<div class="card-body">
					
							<div id="chart" style="height:320px;"></div>
						
					</div>
				</div>
				<div class="card m-t-30">
					<div class="card-header bg-primary text-white">Detay</div>
					<div class="card-body">
						<h5 class="card-title">{{$ping->title}}</h5>
						<p class="card-text">Container Sayısı : {{$ping->container}}</p>
						<p class="card-text">Oluşturan : {{$ping->user->name}}</p>
						<p class="card-text">IP : {{$ping->ip}}</p>
						<p class="card-text">Durum
							: {!! \App\Enums\TaskStatusEnum::from($ping->status)->taskStatusBadge() !!}</p>
						<p class="card-text">Olusturma Tarihi : {{$ping->created_at->format('d.m.Y H:i')}}</p>
						<hr>
						<p class="card-text"><strong>Description:</strong></p>
						<p class="card-text">{{$ping->description}}</p>
					</div>
				</div>
				
				<div class="card m-t-30">
					<div class="card-header bg-primary text-white">Konteynerler</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
								<tr>
									<th>#</th>
									<th>Konteyner ID</th>
									<th>IP</th>
									<th>Ping Sayısı</th>
									<th>Başarılı</th>
									<th>Başarısız</th>
									<th>Min (ms)</th>
									<th>Avg (ms)</th>
									<th>Max (ms)</th>
									<th class="text-center">Detay</th>
								</tr>
								</thead>
								<tbody>
								@foreach($ping->containers as $container)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ Str::limit($container->container_id,20) }}</td>
										<td>{{$container->ip}}</td>
										<td>{{ $container->packets_transmitted }}</td>
										<td>{{ $container->packets_received }}</td>
										<td>{{ $container->packet_loss }}</td>
										<td>{{ $container->min }}</td>
										<td>{{ $container->avg }}</td>
										<td>{{ $container->max }}</td>
										<td class="text-center">
											<button data-toggle="modal" data-target="#exampleModal_{{$loop->iteration}}"
											        class="btn btn-primary-rgba btn-sm"><i class="ri-eye-line"></i>
											</button>
										</td>
									</tr>
									<div class="modal fade" id="exampleModal_{{$loop->iteration}}" tabindex="-1"
									     aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered modal-lg">
											<div class="modal-content bg-dark text-light">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
													<button type="button" class="close" data-dismiss="modal"
													        aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="terminal">
														<div class="terminal-output">
															<p>{!!  \App\Helpers\CommandOutputHelper::trimCommandOutput($container->log)!!}</p>
														</div>
													</div>
												
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary"
													        data-dismiss="modal">Close
													</button>
													<button type="button" class="btn btn-primary">Save changes</button>
												</div>
											</div>
										</div>
									</div>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script>

        var options = {
            series: [],
            chart: {
                id: 'chart',
                height: 350,
                type: 'line'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
              
                curve: 'straight',
              
            },
            xaxis: {
                categories: ["Min", "Ort", "Max", "Loss"]
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var url = `{{route('container.data',$ping->id)}}`;
        $.getJSON(url, function (response) {
            console.log(response)
            ApexCharts.exec('chart', "updateSeries", [...response])
        });
       
	</script>
@endsection