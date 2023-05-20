@extends('layouts.master')
@section('style')
	<link href="{{asset('assets/plugins/apexcharts/apexcharts.css')}}" rel="stylesheet">
@endsection
@section('breadcrumb')
	<div class="breadcrumbbar">
		<div class="row align-items-center">
			<div class="col-md-8 col-lg-8">
				<div class="media">
					<span class="breadcrumb-icon"><i class="ri-dashboard-line"></i></span>
					<div class="media-body">
						<h4 class="page-title">Kontrol Paneli</h4>
						<div class="breadcrumb-list">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0)">MC</a></li>
								<li class="breadcrumb-item active" aria-current="page">Kontrol Paneli</li>
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
			<div class="col-md-6">
				<div class="card m-b-30 border-0">
					<div class="card-header">
						<h5 class="card-title mb-0 text-primary-gradient">Ping Kontainer'leri</h5>
					</div>
					<div class="card-body pb-0">
						<div id="">
							<div class="toolbar">
								<strong id="one_month" class="btn border">
									1M
								</strong>
								
								<strong id="six_months" class="btn border">
									6M
								</strong>
								
								<strong id="all" class="btn border">
									ALL
								</strong>
							</div>
							<div id="chart-timeline"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="card m-b-30 border-0">
					<div class="card-header">
						<h5 class="card-title mb-0 text-primary-gradient">Theharvester Kontainer'leri</h5>
					</div>
					<div class="card-body pb-0">
						<div id="">
							<div class="toolbar">
								<strong id="one_month_theharvester" class="btn border">
									1M
								</strong>
								
								<strong id="six_months_theharvester" class="btn border">
									6M
								</strong>
								
								<strong id="all_theharvester" class="btn border">
									ALL
								</strong>
							</div>
							<div id="chart-timelinehe-theharvester"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- End col -->
			<!-- Start col -->
			<div class="col-lg-6 col-xl-6">
				<div class="card m-b-30">
					<div class="card-header">
						<h5 class="card-title mb-0">Ping Durumu</h5>
					</div>
					<div class="card-body pb-0">
						<div id="chart_ping"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-6">
				<div class="card m-b-30">
					<div class="card-header">
						<h5 class="card-title mb-0">Theharvester Durumu</h5>
					</div>
					<div class="card-body pb-0">
						<div id="chart_theharvester"></div>
					</div>
				</div>
			</div>
			<!-- End col -->
		</div>
		<!-- End row -->
		<!-- Start row -->
		<div class="row">
			<!-- Start col -->
			<div class="col-md-6">
				<div class="card m-b-30">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-12 col-lg-12">
								<h5 class="card-title mb-0">Son 5 Ping görevi</h5>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<thead>
								<tr>
									<th scope="col">#</th>
									<th>Başlık</th>
									<th>Oluşturan</th>
									<th>Durum</th>
									<th>Detay</th>
								</tr>
								</thead>
								<tbody>
								@foreach($pings as $ping)
									<tr>
										<th scope="row">{{$loop->iteration}}</th>
										<td>{{Str::limit( $ping->title,10)}}</td>
										<td>{{$ping->user->name}}</td>
										<td>{!!\App\Enums\TaskStatusEnum::from($ping->status)->taskStatusBadge()!!}</td>
										<td><a href="{{ route('tasks.ping.show',$ping) }}"> <span class="ri-eye-line"> </span></a></td>
									</tr>
								@endforeach
							
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- End col -->
			<!-- Start col -->
			<div class="col-md-6">
				<div class="card m-b-30">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-12 col-lg-12">
								<h5 class="card-title mb-0">Son 5 Theharvester görevi</h5>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-borderless">
								<thead>
								<tr>
									<th scope="col">#</th>
									<th>Başlık</th>
									<th>Oluşturan</th>
									<th>Durum</th>
									<th>Detay</th>
								</tr>
								</thead>
								<tbody>
								@foreach($theharvesters as $theharvester)
									<tr>
										<th scope="row">{{$loop->iteration}}</th>
										<td>{{Str::limit( $ping->title,10)}}</td>
										<td>{{$theharvester->user->name}}</td>
										<td>{!!\App\Enums\TaskStatusEnum::from($theharvester->status)->taskStatusBadge()!!}</td>
										<td><a href="{{ route('tasks.ping.show',$theharvester) }}"> <span class="ri-eye-line"> </span></a></td>
									</tr>
								@endforeach
							
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- End col -->
		</div>
		<!-- End row -->
	</div>
@endsection
@section('script')
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	
	<script>
        var options = {

            series: [{
                name: "Konteyner",
                data: {!! json_encode($pingChart) !!}
            }],
            chart: {
                id: 'area-datetime',
                type: 'area',
                height: 350,
                zoom: {
                    autoScaleYaxis: true
                }
            },
            annotations: {
                yaxis: [{
                    y: 30,
                    borderColor: '#999',
                    label: {
                        show: false,
                        text: 'Support',
                        style: {
                            color: "#fff",
                            background: '#67d1e1'
                        }
                    }
                }],
                xaxis: [{
                    x: new Date('{{now()->format("d M Y")}}').getTime(),
                    borderColor: '#999',
                    yAxisIndex: 0,
                    label: {
                        show: true,
                        text: 'Bugün',
                        style: {
                            color: "#000",
                            background: '#67d1e1'
                        }
                    }
                }]
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
                style: 'hollow',
            },
            colors: ['#67d1e1'],
            xaxis: {
                type: 'datetime',
                min: new Date('{{now()->subWeek()->format("d M Y")}}').getTime(),
                tickAmount: 6,
            },
            tooltip: {
                x: {
                    format: 'dd MMM yyyy'
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 100]
                }
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart-timeline"), options);
        chart.render();


        var resetCssClasses = function (activeEl) {
            var els = document.querySelectorAll('strong');
            Array.prototype.forEach.call(els, function (el) {
                el.classList.remove('btn-primary-rgba');
            });

            activeEl.target.classList.add('btn-primary-rgba');
        };

        document
            .querySelector('#one_month')
            .addEventListener('click', function (e) {
                resetCssClasses(e);

                chart.zoomX(
                    new Date('{{now()->subMonth()->format("d M Y")}}').getTime(),
                    new Date('{{now()->format("d M Y")}}').getTime()
                );
            });

        document
            .querySelector('#six_months')
            .addEventListener('click', function (e) {
                resetCssClasses(e);

                chart.zoomX(
                    new Date('{{now()->subMonths(6)->format("d M Y")}}').getTime(),
                    new Date('{{now()->format("d M Y")}}').getTime()
                );
            });


        document.querySelector('#all').addEventListener('click', function (e) {
            resetCssClasses(e);

            chart.zoomX(
                new Date('{{now()->subYear()->format("d M Y")}}').getTime(),
                new Date('{{now()->format("d M Y")}}').getTime()
            );
        });
	
	</script>
	
	
	<script>
        var options = {

            series: [{
                name: "Konteyner",
                data: {!! json_encode($theharvesterChart) !!}
            }],
            chart: {
                id: 'area-datetime',
                type: 'area',
                height: 350,
                zoom: {
                    autoScaleYaxis: true
                }
            },
            annotations: {
                yaxis: [{
                    y: 30,
                    borderColor: '#999',
                    label: {
                        show: false,
                        text: 'Support',
                        style: {
                            color: "#fff",
                            background: '#9100e4'
                        }
                    }
                }],
                xaxis: [{
                    x: new Date('{{now()->format("d M Y")}}').getTime(),
                    borderColor: '#999',
                    yAxisIndex: 0,
                    label: {
                        show: true,
                        text: 'Bugün',
                        style: {
                            color: "#fff",
                            background: '#9100e4'
                        }
                    }
                }]
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
                style: 'hollow',
            },
            colors: ['#9100e4a1'],
            xaxis: {
                type: 'datetime',
                min: new Date('{{now()->subWeek()->format("d M Y")}}').getTime(),
                tickAmount: 6,
            },
            tooltip: {
                x: {
                    format: 'dd MMM yyyy'
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 100]
                }
            },
        };

        var chart_theharvester = new ApexCharts(document.querySelector("#chart-timelinehe-theharvester"), options);
        chart_theharvester.render();


        var resetCssClasses = function (activeEl) {
            var els = document.querySelectorAll('strong');
            Array.prototype.forEach.call(els, function (el) {
                el.classList.remove('btn-primary-rgba');
            });

            activeEl.target.classList.add('btn-primary-rgba');
        };

        document
            .querySelector('#one_month_theharvester')
            .addEventListener('click', function (e) {
                resetCssClasses(e);

                chart_theharvester.zoomX(
                    new Date('{{now()->subMonth()->format("d M Y")}}').getTime(),
                    new Date('{{now()->format("d M Y")}}').getTime()
                );
            });

        document
            .querySelector('#six_months_theharvester')
            .addEventListener('click', function (e) {
                resetCssClasses(e);

                chart_theharvester.zoomX(
                    new Date('{{now()->subMonths(6)->format("d M Y")}}').getTime(),
                    new Date('{{now()->format("d M Y")}}').getTime()
                );
            });


        document.querySelector('#all_theharvester').addEventListener('click', function (e) {
            resetCssClasses(e);

            chart_theharvester.zoomX(
                new Date('{{now()->subYear()->format("d M Y")}}').getTime(),
                new Date('{{now()->format("d M Y")}}').getTime()
            );
        });
	
	</script>
	
	
	<script>
        var options = {
            series: {!! json_encode($pingPie) !!},
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Başarılı', 'Başarısız', 'Beklemede'],
            colors: ['#218380','#f94144','#999'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart_ping"), options);
        chart.render();
	
	</script>
	<script>
        var options = {
            series: {!! json_encode($theharvesterPie) !!},
            chart: {
                width: 380,
                type: 'pie',
            },
	        colors: ['#9100e4','#ff0020','#999'],
            labels: ['Başarılı', 'Başarısız', 'Beklemede'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        console.log(options)
        var chart = new ApexCharts(document.querySelector("#chart_theharvester"), options);
        chart.render();
	
	</script>

@endsection


