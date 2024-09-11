@extends('layouts.master2')
@section('css')
@endsection
@section('content')
		<div class="d-md-flex">
			<div class="w-40 bg-style h-100vh page-style">
				<div class="page-content">
					<div class="page-single-content">
						<img src="{{URL::asset('assets/images/brand/logo1.png')}}" alt="img" class="header-brand-img mb-5">
						<div class="card-body text-white py-5 px-8 text-center">
							<img src="{{URL::asset('assets/images/png/1.png')}}" alt="img" class="w-100 mx-auto text-center">
						</div>
					</div>
				</div>
			</div>
			<div class="w-80 page-content">
				<div class="page-single-content">
					<div class="card-body p-6">
						<div class="row">
							<div class="col-md-8 mx-auto d-block">
								<div class="">
									<h1 class="mb-2">Forgot Password</h1>
									<p class="text-muted">Forgot Password Page</p>
									<div class="input-group mb-4">
										<span class="input-group-addon"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"/><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"/></svg></span>
										<input type="text" class="form-control" placeholder="Enetr Email">
									</div>
									<div class="form-group">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" />
											<span class="custom-control-label">Agree the <a href="{{ url('/' . $page='terms') }}">terms and policy</a></span>
										</label>
									</div>
									<div class="row">
										<div class="col-12">
											<button type="button" class="btn btn-lg btn-primary btn-block px-4"><i class="fe fe-arrow-right"></i> Send</button>
										</div>
									</div>
								</div>
								<div class="pt-4">
									<div class="font-weight-normal fs-16">Forget it <a class="btn-link font-weight-normal" href="#">Send me back</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection
@section('js')
@endsection