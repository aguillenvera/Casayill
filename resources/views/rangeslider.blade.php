@extends('layouts.master')
@section('css')
<!-- ion.rangeSlider css -->
<link href="{{URL::asset('assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Range Slider</h4>
							</div>
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Home</span></a></li>
									<li class="breadcrumb-item"><a href="#">Apps</a></li>
									<li class="breadcrumb-item active" aria-current="page">Range Slider</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
						<!--div-->
						<div class="card">
							<div class="card-header">
								<div class="card-title">
									Range Slider
								</div>
							</div>
							<div class="card-body">
								<div class="row row-sm">
									<div class="col-lg-12">
										<input class="rangeslider1" name="example_name" type="text" value="">
									</div>
									<div class="col-lg-12 mt-4">
										<input class="rangeslider2" name="example_name" type="text" value="">
									</div>
								</div>
								<div class="row row-sm">
									<div class="col-lg-12 mt-4">
										<input class="rangeslider3" name="example_name" type="text" value="">
									</div>
									<div class="col-lg-12 mt-4">
										<input class="rangeslider4" name="example_name" type="text" value="">
									</div>
								</div>
							</div>
						</div>
						<!--/div-->

						<!--div-->
						<div class="card">
							<div class="card-header">
								<div class="card-title">
									Range Slider (Modern Skin)
								</div>
							</div>
							<div class="card-body">
								<div class="row row-sm">
									<div class="col-lg-12">
										<input class="rangeslider1" data-extra-classes="irs-modern" name="example_name" type="text">
									</div>
									<div class="col-lg-12 mt-4">
										<input class="rangeslider2" data-extra-classes="irs-modern" name="example_name" type="text">
									</div>
								</div>
								<div class="row row-sm">
									<div class="col-lg-12 mt-4">
										<input class="rangeslider3" data-extra-classes="irs-modern" name="example_name" type="text">
									</div>
									<div class="col-lg-12 mt-4">
										<input class="rangeslider4" data-extra-classes="irs-modern" name="example_name" type="text">
									</div>
								</div>
							</div>
						</div>
						<!--/div-->

						<!--div-->
						<div class="card">
							<div class="card-header">
								<div class="card-title">
									Range Slider (Outline Skin)
								</div>
							</div>
							<div class="card-body">
								<div class="row row-sm">
									<div class="col-lg-12">
										<input class="rangeslider1" data-extra-classes="irs-outline" name="example_name" type="text">
									</div>
									<div class="col-lg-12 mt-4">
										<input class="rangeslider2" data-extra-classes="irs-outline" name="example_name" type="text">
									</div>
								</div>
								<div class="row row-sm">
									<div class="col-lg-12 mt-4">
										<input class="rangeslider3" data-extra-classes="irs-outline" name="example_name" type="text">
									</div>
									<div class="col-lg-12 mt-4">
										<input class="rangeslider4" data-extra-classes="irs-outline" name="example_name" type="text">
									</div>
								</div>
							</div>
						</div>
						<!--/div-->

					</div>
				</div><!-- end app-content-->
			</div>
@endsection
@section('js')
<!-- ion.rangeSlider.min js -->
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{URL::asset('assets/js/rangeslider.js')}}"></script>
@endsection