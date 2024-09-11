@extends('layouts.master')
@section('css')
<!-- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
<!--Images-Comparsion css -->
<link href="{{URL::asset('assets/plugins/img-crop/cropme.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Image Crop</h4>
							</div>
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Home</span></a></li>
									<li class="breadcrumb-item"><a href="#">Apps</a></li>
									<li class="breadcrumb-item active" aria-current="page">Image Crop</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
						<div class="row mt-5" id="app">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Image Crop</div>
									</div>
									<div class="card-body p-0">
										<div class="row no-gutters">
											<div class="col-lg-5 col-xl-6 border-right">
												<div class="pl-7 pb-7 pt-5 pr-5">
													<div id="cropme"></div><!-- Modal -->
													<div aria-hidden="true" class="modal fade" id="cropmeModal" role="dialog" tabindex="-1">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Cropme result</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
																</div>
																<div class="modal-body text-center"><img alt="cropme" id="cropme-result"></div>
															</div>
														</div>
													</div>
													<div aria-hidden="true" class="modal fade" id="cropmePosition" role="dialog" tabindex="-1">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Cropme Position output</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
																</div>
																<div class="modal-body">
																	<pre><code> position </code></pre>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-7 col-xl-6">
												<div class="options px-5 pt-5  border-bottom pb-3">
													<div class="row">
														<div class="col-md-6 mb-4">
															<div class="title font-weight-semibold text-uppercase mb-3">
																Viewport Type
															</div>
															<select class="form-control  select2">
																<option value="square">
																	square (default)
																</option>
																<option value="circle">
																	circle
																</option>
															</select>
														</div>
														<div class="col-md-6 mb-4">
															<div class="title font-weight-semibold text-uppercase mb-3">
																transform origin center
															</div>
															<select class="form-control select2">
																<option value="image">
																	image
																</option>
																<option value="viewport">
																	viewport (default)
																</option>
															</select>
														</div>
													</div>
												</div>
												<div class="options px-5 pt-5  border-bottom pb-3">
													<div class="title font-weight-semibold text-uppercase mb-3">
														Border
													</div>
													<div class="row">
														<div class="col-md-4 mb-4">
															<label class="text-capitalize">enable</label>
															<select class="form-control select2">
																<option>
																	true (default)
																</option>
																<option>
																	false
																</option>
															</select>
														</div>
														<div class="col-md-4 mb-4">
															<label class="text-capitalize">width</label>
															<select class="form-control  select2">
																<option value="2">
																	2 (default)
																</option>
																<option value="5">
																	5
																</option>
																<option value="10">
																	10
																</option>
															</select>
														</div>
														<div class="col-md-4 mb-4">
															<label class="text-capitalize">color</label>
															<select class="form-control  select2">
																<option value="#fff">
																	white (default)
																</option>
																<option value="#f00">
																	red
																</option>
																<option value="#00f">
																	bleu
																</option>
															</select>
														</div>
													</div>
												</div>
												<div class="options px-5 pt-5  border-bottom pb-3">
													<div class="title font-weight-semibold text-uppercase mb-3">
														Zoom
													</div>
													<div class="row">
														<div class="col-md-4 mb-4">
															<label class="text-capitalize">enable</label>
															<select class="form-control select2">
																<option>
																	true (default)
																</option>
																<option>
																	false
																</option>
															</select>
														</div>
														<div class="col-md-4 mb-4">
															<label class="text-capitalize">mouseWheel</label>
															<select class="form-control  select2">
																<option>
																	true (default)
																</option>
																<option>
																	false
																</option>
															</select>
														</div>
														<div class="col-md-4 mb-4">
															<label class="text-capitalize">slider</label>
															<select class="form-control  select2">
																<option>
																	true
																</option>
																<option>
																	false (default)
																</option>
															</select>
														</div>
													</div>
												</div>
												<div class="options px-5 pt-5  border-bottom pb-3">
													<div class="title font-weight-semibold text-uppercase mb-3">
														Rotation
													</div>
													<div class="row">
														<div class="col-md-4 mb-4">
															<label class="text-capitalize">enable</label>
															<select class="form-control  select2">
																<option>
																	true (default)
																</option>
																<option>
																	false
																</option>
															</select>
														</div>
														<div class="col-md-4 mb-4">
															<label class="text-capitalize">slider</label>
															<select class="form-control select2">
																<option>
																	true
																</option>
																<option>
																	false (default)
																</option>
															</select>
														</div>
														<div class="col-md-4 mb-4">
															<label class="text-capitalize">Position</label>
															<select class="form-control select2">
																<option value="left">
																	left
																</option>
																<option value="right">
																	right (default)
																</option>
															</select>
														</div>
													</div>
												</div>
												<div class="p-5">
													<button class="btn btn-danger">Reset</button>
													<button class="btn btn-success float-right">Crop me</button>
													<button class="btn btn-primary float-right mr-3">Get position</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">

							</div>
						</div>

					</div>
				</div><!-- end app-content-->
			</div>
@endsection
@section('js')
<!--Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!-- Images-Comparsion js -->
<script src="{{URL::asset('assets/plugins/img-crop/vue.js')}}"></script>
<script src="{{URL::asset('assets/plugins/img-crop/cropme.js')}}"></script>
<script src="{{URL::asset('assets/js/img-crop.js')}}"></script>
@endsection