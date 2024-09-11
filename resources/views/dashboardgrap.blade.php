@extends('layouts.master')
@section('css')
<!---jvectormap css-->
<link href="{{URL::asset('assets/plugins/jvectormap/jqvmap.css')}}" rel="stylesheet" />
<!-- Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<!-- Slect2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
<!--Daterangepicker css-->
<link href="{{URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<div class="form-group">
                                    <div class="row">     

                                        </div>
                                    </div>
							    </div>

						</div>
						<!--End Page header-->
@endsection
@section('content')
						<!--Row-->
                        <div class="row justify-content-center align-items-center">
						<div class="col-xl-12 col-md-12 col-lg-12">
                        <div class="row justify-content-center align-items-center">
								<div class="col-xl-1 col-lg-1"></div>
                                    @if( Auth::user()->isAdmin())
                                        <div class="col-xl-2 col-lg-3 col-md-5">
                                            <a href="{{route('empleado.index')}}">    

                                            <div class="card text-center mx-auto card-index">
                                                <div class="card-body">
                                                <img width="200rem" src="{{ asset('assets/images/iconsIndex/nomina.png') }}" alt="Empleados">
                                                <div class="">
                                                <h4 class="card-title">Ver todos los empleados</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            </a>

                                        </div>
                                        
                                        <div class="col-xl-2 col-lg-3 col-md-5">
                                            <a href="{{ route('nomina.index') }}">    

                                            <div class="card text-center mx-auto card-index">
                                                <div class="card-body">
                                                <img width="200rem" src="{{ asset('assets/images/iconsIndex/nominaSueldo.png') }}" alt="Nomina ">
                                                <div class="">
                                                <h4 class="card-title">Nomina de Empleados</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            </a>

                                        </div> 
                                     @endif
                                     
                                     <div class="col-xl-2 col-lg-3 col-md-5">
                                         <a href="{{route('inventario.create')}}">    

                                        <div class="card text-center mx-auto card-index">
											<div class="card-body">
                                            <img width="200rem" src="{{ asset('assets/images/iconsIndex/3207415.webp') }}" alt="Ingreso de Porductos">
                                            <div class="">
                                            <h4 class="card-title">Ingresar producto </h4>
                                                </div>
											</div>
										</div>
                                        </a>

									</div> 
                                    
                                    <div class="col-xl-2 col-lg-3 col-md-5">
                                        <a href="{{route('inventario.indexVenta')}}">    

                                        <div class="card text-center mx-auto card-index">

											<div class="card-body">
                                            <img width="200rem" src="{{ asset('assets/images/iconsIndex/tienda.png') }}" alt="Inventario de productos">
                                            <div class="">
                                            <h4 class="card-title">Ver todos los productos de venta</h4>
                                                </div>
											</div>
										</div>
                                        </a>

									</div> 

                                    <div class="col-xl-2 col-lg-3 col-md-5">
                                        <a href="{{route('inventario.indexAlquiler')}}">    

                                        <div class="card text-center mx-auto card-index">

											<div class="card-body">
                                            <img width="200rem" src="{{ asset('assets/images/iconsIndex/clothing_shop_icon_192653.webp') }}" alt="Inventario de productos">
                                            <div class="">
                                            <h4 class="card-title">Ver todos los productos de Alquiler</h4>
                                                </div>
											</div>
										</div>
                                        </a>

									</div> 
                                
                                    
                                    <div class="col-xl-2 col-lg-3 col-md-5">
                                        <a href="{{route('cliente.index')}}">    

                                        <div class="card text-center mx-auto card-index">
											<div class="card-body">
                                            <img width="200rem" src="{{ asset('assets/images/iconsIndex/6009864.webp') }}" alt="Inventario de Clientes">
                                            <div class="">
                                            <h4 class="card-title">Ver todos los clientes </h4>
                                                </div>
											</div>
										</div>
                                        </a>

									</div> 
                                    <div class="col-xl-2 col-lg-3 col-md-5">
                                        <a href="{{route('cliente.create')}}">    

                                        <div class="card text-center mx-auto card-index">
											<div class="card-body">
                                            <img width="200rem" src="{{ asset('assets/images/iconsIndex/descargar.webp') }}" alt="Ingresar Clientes">
                                            <div class="">
                                            <h4 class="card-title">Registrar un cliente</h4>
                                                </div>  
											</div>
										</div>
                                        </a>

									</div>

                                    <div class="col-xl-2 col-lg-3 col-md-5">
                                        <a href="{{ route('venta.create') }}">    
                                            <div class="card text-center mx-auto card-index">
                                                <div class="card-body">
                                                <img width="200rem" src="{{ asset('assets/images/iconsIndex/venta.png') }}" alt="Ordenes de entrega">
                                                <div class="">
                                                <h4 class="card-title">Vender productos</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
									</div>

                                    <div class="col-xl-2 col-lg-3 col-md-5">
                                    <a href="{{ route('alquiler.create') }}">    

                                        <div class="card text-center mx-auto card-index">
											<div class="card-body">
                                            <img width="200rem" src="{{ asset('assets/images/iconsIndex/alquiler.png') }}" alt="Ingresar ordenes">
                                            <div class="">
                                            <h4 class="card-title">Alquilar productos</h4>
                                                </div>
											</div>
										</div>
                                        </a>

									</div>
                                    <div class="col-xl-2 col-lg-2 col-md-5">
                                    <a href="{{ route('venta.index') }}">    

                                        <div class="card text-center mx-auto card-index">
											<div class="card-body">
                                            <img width="200rem" src="{{ asset('assets/images/iconsIndex/951626.webp') }}" alt="Ventas Registro">
                                            <div class="">
                                            <h4 class="card-title">Ver todas las ventas</h4>
                                                </div>
											</div>
										</div>
                                        </a>

									</div>
                                    <div class="col-xl-2 col-lg-2 col-md-5">
                                    <a href="{{ route('alquiler.index') }}">    

                                        <div class="card text-center mx-auto card-index">
											<div class="card-body">
                                            <img width="200rem" src="{{ asset('assets/images/iconsIndex/2082194.webp') }}" alt="Alquileres Registro">
                                            <div class="">
                                            <h4 class="card-title">Ver todos los alquileres</h4>
                                                </div>
											</div>
										</div>
                                        </a>

									</div>
                                    @if( Auth::user()->isAdmin())

                                    <div class="col-xl-2 col-lg-2 col-md-5">
                                    <a href="{{ route('ingreso.index') }}">    

                                        <div class="card text-center mx-auto card-index">
											<div class="card-body">
                                            <img width="200rem" src="{{ asset('assets/images/iconsIndex/ingresos.png') }}" alt="ingresos Diarios">
                                            <div class="">
                                            <h4 class="card-title">Ver todos los ingresos diarios</h4>
                                                </div>
											</div>
										</div>
                                        </a>

									</div>
                                    <div class="col-xl-2 col-lg-2 col-md-5">
                                    <a href="{{ route('gasto.index') }}">    

                                        <div class="card text-center mx-auto card-index">
											<div class="card-body">
                                            <img width="200rem" src="{{ asset('assets/images/iconsIndex/energia.png') }}" alt="Gastos Diarios">
                                            <div class="">
                                            <h4 class="card-title">Ver todos los gastos diarios</h4>
                                                </div>
											</div>
										</div>
                                        </a>

									</div>
                                    @endif

								</div>
							</div>
					</div>
				</div><!-- end app-content-->
			</div>
            <style>
  .card-index:hover { 
    background-color: #e6e6ff;
  }
</style>
@endsection
@section('js')
<!-- Peitychart js-->
<script src="{{URL::asset('assets/plugins/peitychart/jquery.peity.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/peitychart/peitychart.init.js')}}"></script>
<!-- Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!--Moment js-->
<script src="{{URL::asset('assets/plugins/moment/moment.js')}}"></script>
<!-- Daterangepicker js-->
<script src="{{URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
{{-- <script src="{{URL::asset('assets/js/daterange.js')}}"></script> --}}
<!---jvectormap js-->
<script src="{{URL::asset('assets/plugins/jvectormap/jquery.vmap.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jvectormap/jquery.vmap.world.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jvectormap/jquery.vmap.sampledata.js')}}"></script>
<!-- Index js-->
<script src="{{URL::asset('assets/js/index1.js')}}"></script>
<!--Counters -->
<script src="{{URL::asset('assets/plugins/counters/counterup.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/counters/waypoints.min.js')}}"></script>
<!--Chart js -->
<script src="{{URL::asset('assets/plugins/chart/chart.bundle.js')}}"></script>
<script src="{{URL::asset('assets/plugins/chart/utils.js')}}"></script>

<!--DateFormat -->
<script src="{{URL::asset('assets/js/jquery-dateformat.min.js')}}"></script>

<script>
    $(document).ready(function(){
        var f = new Date();
        var store_id = $('#store option:checked').val();
        var dateS = (f.getFullYear() + "-" + (f.getMonth() +1) + "-" + (f.getDate()-1));
        var dateE = (f.getFullYear() + "-" + (f.getMonth() +1) + "-" + (f.getDate()-1));
     
        storeCharge(store_id, dateS, dateE);

    });

    $('#daterange-btn').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(1, 'days'),
            endDate: moment().subtract(1, 'days')
        }, function(start, end) {
            $('#daterange-btn span').html(start.format('MMMM DD, YYYY') + ' - ' + end.format('MMMM DD, YYYY'));
            var store_id = $('#store option:selected').val();
            console.log(store_id)
            storeCharge(store_id, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        });
    function storeCharge(store, dateStart, dateEnd){
        console.log(dateStart, dateEnd);
        $.ajax({url:'sale/'+store+'/show',
            type:'get',
            dataType:"json",
            data:{
                dateStart:dateStart,
                dateEnd:dateEnd
            }

		})
        .done(function(e){
            console.log('Respuesta de la llamada AJAX:', e);

            var f=e, comps=0, promos=0, voids=0, taxes=0, grsals=0, maxChart = 0;
            let axisX = [], dataChart = [];
			$.each(f,function(index, el) {
                comps+=el.comp;
                promos+=el.promo;
                voids+=el.void;
                taxes+=el.taxes;
                grsals+=el.grs_sale;
                axisX[index]=el.name;
                dataChart[index]=el.net_sale;
                if(maxChart < el.net_sale)
                    maxChart=el.net_sale
            });
            $('#comps').text(comps);
            $('#promos').text(promos);
            $('#voids').text(voids);
            $('#taxes').text(taxes);
            $('#grssales').text(grsals);

            'use strict';
            $('#chartBar1').remove();
            $('#canvasCont').append('<canvas id="chartBar1" class="h-300"><canvas>');
            var ctx1 = document.getElementById('chartBar1').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: axisX,
                    datasets: [{
                        label: 'Products',
                        data: dataChart,
                        backgroundColor: '#f72d66'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false,
                        labels: {
                            display: false
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontSize: 10,
                                max: maxChart,
                                fontColor: "#ababab",
                            },
                            gridLines: {
                                color: 'rgba(180, 183, 197, 0.4)'
                            }
                        }],
                        xAxes: [{
                            barPercentage: 0.6,
                            ticks: {
                                beginAtZero: true,
                                fontSize: 10,
                                fontColor: "#ababab",
                            },
                            gridLines: {
                                color: 'rgba(180, 183, 197, 0.4)'
                            }
                        }]
                    }
                }
            });

        });
    }
</script>
@endsection

