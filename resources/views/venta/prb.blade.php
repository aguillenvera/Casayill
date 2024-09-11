@extends('layouts.master')
@section('css')
<!-- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Crear Factura</h4>
							</div>
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Dashboard</span></a></li>
									<li class="breadcrumb-item"><a href="{{ route('factura.index') }}">Site Panel</a></li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
                        <!-- Row -->
                        @if(Session::has('success'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{Session::get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
			            @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card">
                                    <div class="card-header">
										<div class="card-title">Crear Factura</div>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('factura.store') }}"  role="form">
                                            {{ csrf_field() }}
                                            <div class="input-group mb-5">
                                                <span class="card-title"> Datos de la Factura:</span>
                                            </div>
                                            <div class="input-group mb-3 ml-3">
                                            <ul>
                                                    <li class="card-subtitle p-1">
                                                        <b> Nombre Completo de la persona :</b> {{$orden->name . " " . $orden->apellido}}
                                                        <input type="hidden" name="name" value="{{$orden->name . ' '  . $orden->apellido}}">
                                                    </li>
                                                    <li class="card-subtitle p-1">
                                                        <b>Direccion: </b> {{$orden->direccion}}
                                                        <input type="hidden" name="direccion" value="{{$orden->direccion}}">
                                                    </li>
                                                    <li class="card-subtitle p-1">
                                                        <b>Telefono: </b> {{$orden->telefono}}
                                                        <input type="hidden" name="telefono" value="{{$orden->telefono}}">
                                                    </li>
                                                    <li class="card-subtitle p-1">
                                                        <b>Fecha de Entrega</b> {{ date('Y-m-d')}}
                                                        <input type="hidden" name="fecha_entrega" value="{{ date('Y-m-d')}}">
                                                    </li>
                                                    <li class="card-subtitle p-1">
                                                        <b>RIF</b> 12345678
                                                        <input type="hidden" name="rif" value="12345678">
                                                    </li>
                                                    <li class="card-subtitle p-1">
                                                        <b>Total Abonado en USD:</b> {{$orden->abonado}} $
                                                    </li>
                                                    <li class="card-subtitle p-1">
                                                        <b>Control</b>0001
                                                        <input type="hidden" name="control" value="0001">

                                                    </li>
                                                </ul>
                                            </div>


                                            <div class="input-group mb-5">
                                                <span class="card-title"> <b>Total:</b> {{$orden->precio}} $ USD.</span>
                                            </div>
                                            <div class="input-group mb-3 ml-3">
                                                <ul>
                                                    @forEach( $orden->ordenInventario as $product)
                                                        <li class="card-subtitle p-1"><b> {{$product->nombre . " marca " . $product->marca }}:</b> {{$product->precio }} $</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <input type="hidden" id="products" name="products" value="{{$orden->ordenInventario}}">
                                            <input type="hidden" id="ordenId" name="ordenId" value="{{$orden->id}}">


                                            <div class="input-group mb-2">
                                                <span class="card-title" id="suma-precio"> <b>SubTotal:</b> {{$orden->precio +  $orden->precio * 0.16}}</span> <br>

                                            </div>
                           

                                   

                                            <div class="input-group mb-3 w-100">

                                                <span class="card-title"> Seleccione la Moneda con la que va a pagar</span>

                                                <select  class="select2 " name="divisas" id="divisas" style="width : 100%">
                                                            <option value="Bs" selected>BS</option>
                                                            <option value="COP">COP</option>
                                                            <option value="USD">USD</option>
                                                </select>
                                            </div>
                                            <span class="card-title mb-5"  id="PagarPrecio"> <b>Falta por pagar :</b></span>

                                            <div class="form-group mt-5">
                                                <div class="row d-flex justify-content-start">
                                                <div class="p-2 col-2 "><label class=" card-title">Desea Factura?</label>
                                                <input type="checkbox" name="factura" id="factura" class=" ms-3 form-check-input">

                                            </div>

                                                </div>
                                            </div>
                               
                                            <input type="hidden" id="inputSumaPrecio" name="inputSumaPrecio">


                            

                                            <div class="col-xs-12 mt-5">
                                                <button type="submit" class="btn btn-lg btn-primary" onclick="redirectIndex()">Crear</button>
                                                <a href="{{ route('orden.index') }}" class="btn btn-lg btn-danger">Cancelar</a>
                                            </div>
                                        </form>
                                    </div>
								</div>
							</div>
						</div>
						<!-- End Row-->

					</div>
				</div><!-- end app-content-->
			</div>
@endsection
@section('js')
<script>
   function redirectIndex() {
        setTimeout(function() {
        window.location.href = "{{ route('factura.index') }}";
    }, 4000); 
    };


</script>
<script>
    $(document).ready(function() {
       $('#divisas').on('change', function() {
        let selectedIds = $(this).val();

        let orden = @json($orden);
        let tasa = @json($divisa);
        let total = orden.precio
        const precioTotal = total + (total*0.16)
        let tasaSelect = tasa.find(objeto => objeto.name === selectedIds);
        const abonado = tasaSelect.tasa * orden.abonado;
        const conversion =  precioTotal *  tasaSelect.tasa;


        if(selectedIds == 'Bs' ){
            $('#PagarPrecio').text( ` Falta por pagar : ${conversion - abonado} ${tasaSelect.name}` );
            $('#suma-precio').text('SubTotal: ' +conversion.toFixed(2) + tasaSelect.name  );
            $('#inputSumaPrecio').val(conversion.toFixed(2));

        }else{
            const TotalDivisaS = conversion + conversion*0.03;
            $('#PagarPrecio').text( `Falta por pagar : ${TotalDivisaS - abonado} ${tasaSelect.name}` );
            $('#suma-precio').text(`SubTotal: ${TotalDivisaS.toFixed(2)  } ${tasaSelect.name} y en Bs ${((TotalDivisaS /  tasaSelect.tasa )  * tasa[2].tasa ).toFixed(2)} `  );
            $('#inputSumaPrecio').val(TotalDivisaS.toFixed(3));



        }

    });
    $('#divisas').trigger('change');

});
</script>
<!--Select2 js -->


<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection
