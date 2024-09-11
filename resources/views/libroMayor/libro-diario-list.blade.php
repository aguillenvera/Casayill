@extends('layouts.master')
@section('css')
<!-- Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<!-- Slect2 css -->
<link href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{$libroMayor->cuenta}}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Dashboard</span></a></li>
			<li class="breadcrumb-item"><a href="{{ route('libroMayor.index') }}">Ver libros Mayores</a></li>
		</ol>
	</div>
</div>
<!--End Page header-->
@endsection
@section('content')

@php
use App\Models\LibroMayor;
@endphp
<!--Row-->
@if(Session::has('success'))
<div class="alert alert-{{ session('success.alert') }} alert-dismissible fade show" role="alert">
    {{ session('success.message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="row row-deck">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Saldo de la Cuenta - {{$libroMayor->saldo}}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered text-nowrap key-buttons" style="border-color:#eff0f6;">
                        <thead style="border-color:#eff0f6;">
                            <th class="border-bottom-0">Concepto</th>
                            <th class="border-bottom-0">Debe</th>
                            <th class="border-bottom-0">Cuenta Debe</th>
                            <th class="border-bottom-0">Haber</th>
                            <th class="border-bottom-0">Cuenta Haber</th>
                            <th class="border-bottom-0">Fecha de Creación</th>
                            <th style="border-color:#eff0f6;"></th>
                        </thead>
                        <tbody id="contentTable">
                            @foreach($resultados as $resultado)
                            <tr class="bold producto-row">
                                <td>{{ $resultado->concepto }}</td>
                                <td>
                                    @if(is_string($resultado->debe))
                                        {{ '$' . implode(', $', json_decode($resultado->debe)) }}
                                    @else
                                        {{ '$' . implode(', $', $resultado->debe) }}
                                    @endif
                                </td>
                                <td>
                                @php
                                    $cuentasProcesadas = new \Illuminate\Support\Collection();
                                @endphp

                                @foreach($registrosRelacionados as $registroRelacionado)
                                    @foreach($registroRelacionado['debe'] as $id)
                                        @if (!is_null($resultado->debeIdMayor) && in_array($id->id, $resultado->debeIdMayor) && !$cuentasProcesadas->contains($id->cuenta))
                                            {{ $id->cuenta }},
                                            @php
                                                $cuentasProcesadas->push($id->cuenta);
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach


                                </td>
                                <td>
                                    @if(is_string($resultado->haber))
                                        {{ '$' . implode(', $', json_decode($resultado->haber)) }}
                                    @else
                                        {{ '$' . implode(', $', $resultado->haber) }}
                                    @endif
                                </td>
                                <td>
                                @php
                                    $cuentasProcesadasHaber = new \Illuminate\Support\Collection();
                                @endphp

                                @foreach($registrosRelacionados as $registroRelacionado)
                                    @foreach($registroRelacionado['haber'] as $id)
                                        @if (!is_null($resultado->haberIdMayor) && in_array($id->id, $resultado->haberIdMayor) && !$cuentasProcesadasHaber->contains($id->cuenta))
                                            {{ $id->cuenta }},
                                            @php
                                                $cuentasProcesadasHaber->push($id->cuenta);
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach


                                </td>
                                <td>{{ $resultado->fecha }}</td>
                                <td></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables.js') }}"></script>
<!-- Select2 js -->
<script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js') }}"></script>
@endsection
