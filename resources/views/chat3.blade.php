@extends('layouts.master')
@section('css')
<!-- lightslider css -->
<link href="{{URL::asset('assets/plugins/lightslider/css/lightslider.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title">Pop up Chat</h4>
							</div>
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Home</span></a></li>
									<li class="breadcrumb-item"><a href="#">Apps</a></li>
									<li class="breadcrumb-item"><a href="#">Chats</a></li>
									<li class="breadcrumb-item active" aria-current="page">Pop up Chat</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
@endsection
@section('content')
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="row">

									<!-- col -->
									<div class="col-lg-6">
										<div class="card">
											<div class="card-body p-0">
												<div class="chat-widget-header d-flex p-5">
													<div class="font-weight-bold d-flex">
														<img  class="avatat avatar-md brround mr-2" src="{{URL::asset('assets/images/users/1.jpg')}}" alt="img">
														<div class="mt-1 d-none d-sm-block">
															<h6 class="font-weight-semibold mb-0">Shamika Griffith</h6>
															<small>shamikagriffith@gmail.com</small>
														</div>
													</div>
													<div class="ml-auto">
														<div class="d-flex">
															<a class="option-dots new-list2" href="#" data-toggle="modal" data-target="#chatmodel" data-placement="top" data-toggle="tooltip" title="Chat"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 4H4v13.17L5.17 16H20V4zm-6 10H6v-2h8v2zm4-3H6V9h12v2zm0-3H6V6h12v2z" opacity=".3"/><path d="M20 18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14zm-16-.83V4h16v12H5.17L4 17.17zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="call"><svg  class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM5.03 5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.23-.84-.38-1.71-.44-2.6H5.03z" opacity=".3"/><path d="M9.07 7.57C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02zm7.33 9.45c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.79 8.8c-.41-1.21-.67-2.48-.76-3.8h1.5c.07.89.22 1.76.46 2.59L5.79 8.8z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="Video Cal"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 8h10v8H5z" opacity=".3"/><path d="M17 7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7zm-2 9H5V8h10v8z"/></svg></a>
															<a class="option-dots new-list2" data-toggle="dropdown" href="#"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></a>
															<div class="dropdown-menu tx-13 dropdown-menu-right">
																<a class="dropdown-item" href="#">Assigned to</a>
																<a class="dropdown-item" href="#">Mark As Unread</a>
																<a class="dropdown-item" href="#">Mark As Important</a>
																<a class="dropdown-item" href="#">Add to Tasks</a>
																<a class="dropdown-item" href="#">Add Star</a>
																<a class="dropdown-item" href="#">Move to</a>
																<a class="dropdown-item" href="#">Mute</a>
																<a class="dropdown-item" href="#">Move to Trash</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /col -->
									<!-- col -->
									<div class="col-lg-6">
										<div class="card">
											<div class="card-body p-0">
												<div class="chat-widget-header d-flex p-5">
													<div class="font-weight-bold d-flex">
														<img  class="avatat avatar-md brround mr-2" src="{{URL::asset('assets/images/users/2.jpg')}}" alt="img">
														<div class="mt-1 d-none d-sm-block">
															<h6 class="font-weight-semibold mb-0">Margarette Wycoff</h6>
															<small>margarettewycoff@gmail.com</small>
														</div>
													</div>
													<div class="ml-auto">
														<div class="d-flex">
															<a class="option-dots new-list2" href="#" data-toggle="modal" data-target="#chatmodel" data-placement="top" data-toggle="tooltip" title="Chat"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 4H4v13.17L5.17 16H20V4zm-6 10H6v-2h8v2zm4-3H6V9h12v2zm0-3H6V6h12v2z" opacity=".3"/><path d="M20 18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14zm-16-.83V4h16v12H5.17L4 17.17zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="call"><svg  class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM5.03 5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.23-.84-.38-1.71-.44-2.6H5.03z" opacity=".3"/><path d="M9.07 7.57C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02zm7.33 9.45c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.79 8.8c-.41-1.21-.67-2.48-.76-3.8h1.5c.07.89.22 1.76.46 2.59L5.79 8.8z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="Video Cal"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 8h10v8H5z" opacity=".3"/><path d="M17 7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7zm-2 9H5V8h10v8z"/></svg></a>
															<a class="option-dots new-list2" data-toggle="dropdown" href="#"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></a>
															<div class="dropdown-menu tx-13 dropdown-menu-right">
																<a class="dropdown-item" href="#">Assigned to</a>
																<a class="dropdown-item" href="#">Mark As Unread</a>
																<a class="dropdown-item" href="#">Mark As Important</a>
																<a class="dropdown-item" href="#">Add to Tasks</a>
																<a class="dropdown-item" href="#">Add Star</a>
																<a class="dropdown-item" href="#">Move to</a>
																<a class="dropdown-item" href="#">Mute</a>
																<a class="dropdown-item" href="#">Move to Trash</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /col -->
									<!-- col -->
									<div class="col-lg-6">
										<div class="card">
											<div class="card-body p-0">
												<div class="chat-widget-header d-flex p-5">
													<div class="font-weight-bold d-flex">
														<img class="avatat avatar-md brround mr-2" src="{{URL::asset('assets/images/users/3.jpg')}}" alt="img">
														<div class="mt-1 d-none d-sm-block">
															<h6 class="font-weight-semibold mb-0">Myrta Powe</h6>
															<small>myrtapower@gmail.com</small>
														</div>
													</div>
													<div class="ml-auto">
														<div class="d-flex">
															<a class="option-dots new-list2" href="#" data-toggle="modal" data-target="#chatmodel" data-placement="top" data-toggle="tooltip" title="Chat"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 4H4v13.17L5.17 16H20V4zm-6 10H6v-2h8v2zm4-3H6V9h12v2zm0-3H6V6h12v2z" opacity=".3"/><path d="M20 18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14zm-16-.83V4h16v12H5.17L4 17.17zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="call"><svg  class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM5.03 5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.23-.84-.38-1.71-.44-2.6H5.03z" opacity=".3"/><path d="M9.07 7.57C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02zm7.33 9.45c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.79 8.8c-.41-1.21-.67-2.48-.76-3.8h1.5c.07.89.22 1.76.46 2.59L5.79 8.8z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="Video Cal"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 8h10v8H5z" opacity=".3"/><path d="M17 7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7zm-2 9H5V8h10v8z"/></svg></a>
															<a class="option-dots new-list2" data-toggle="dropdown" href="#"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></a>
															<div class="dropdown-menu tx-13 dropdown-menu-right">
																<a class="dropdown-item" href="#">Assigned to</a>
																<a class="dropdown-item" href="#">Mark As Unread</a>
																<a class="dropdown-item" href="#">Mark As Important</a>
																<a class="dropdown-item" href="#">Add to Tasks</a>
																<a class="dropdown-item" href="#">Add Star</a>
																<a class="dropdown-item" href="#">Move to</a>
																<a class="dropdown-item" href="#">Mute</a>
																<a class="dropdown-item" href="#">Move to Trash</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /col -->
									<!-- col -->
									<div class="col-lg-6">
										<div class="card">
											<div class="card-body p-0">
												<div class="chat-widget-header d-flex p-5">
													<div class="font-weight-bold d-flex">
														<img class="avatat avatar-md brround mr-2" src="{{URL::asset('assets/images/users/4.jpg')}}" alt="img">
														<div class="mt-1 d-none d-sm-block">
															<h6 class="font-weight-semibold mb-0">Consuelo Valenzuela</h6>
															<small>consuelovalenzuela@gmail.com</small>
														</div>
													</div>
													<div class="ml-auto">
														<div class="d-flex">
															<a class="option-dots new-list2" href="#" data-toggle="modal" data-target="#chatmodel" data-placement="top" data-toggle="tooltip" title="Chat"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 4H4v13.17L5.17 16H20V4zm-6 10H6v-2h8v2zm4-3H6V9h12v2zm0-3H6V6h12v2z" opacity=".3"/><path d="M20 18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14zm-16-.83V4h16v12H5.17L4 17.17zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="call"><svg  class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM5.03 5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.23-.84-.38-1.71-.44-2.6H5.03z" opacity=".3"/><path d="M9.07 7.57C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02zm7.33 9.45c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.79 8.8c-.41-1.21-.67-2.48-.76-3.8h1.5c.07.89.22 1.76.46 2.59L5.79 8.8z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="Video Cal"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 8h10v8H5z" opacity=".3"/><path d="M17 7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7zm-2 9H5V8h10v8z"/></svg></a>
															<a class="option-dots new-list2" data-toggle="dropdown" href="#"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></a>
															<div class="dropdown-menu tx-13 dropdown-menu-right">
																<a class="dropdown-item" href="#">Assigned to</a>
																<a class="dropdown-item" href="#">Mark As Unread</a>
																<a class="dropdown-item" href="#">Mark As Important</a>
																<a class="dropdown-item" href="#">Add to Tasks</a>
																<a class="dropdown-item" href="#">Add Star</a>
																<a class="dropdown-item" href="#">Move to</a>
																<a class="dropdown-item" href="#">Mute</a>
																<a class="dropdown-item" href="#">Move to Trash</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /col -->
									<!-- col -->
									<div class="col-lg-6">
										<div class="card">
											<div class="card-body p-0">
												<div class="chat-widget-header d-flex p-5">
													<div class="font-weight-bold d-flex">
														<img class="avatat avatar-md brround mr-2" src="{{URL::asset('assets/images/users/5.jpg')}}" alt="img">
														<div class="mt-1 d-none d-sm-block">
															<h6 class="font-weight-semibold mb-0">Carolyne Wirtz</h6>
															<small>carolynewirtz@gmail.com</small>
														</div>
													</div>
													<div class="ml-auto">
														<div class="d-flex">
															<a class="option-dots new-list2" href="#" data-toggle="modal" data-target="#chatmodel" data-placement="top" data-toggle="tooltip" title="Chat"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 4H4v13.17L5.17 16H20V4zm-6 10H6v-2h8v2zm4-3H6V9h12v2zm0-3H6V6h12v2z" opacity=".3"/><path d="M20 18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14zm-16-.83V4h16v12H5.17L4 17.17zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="call"><svg  class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM5.03 5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.23-.84-.38-1.71-.44-2.6H5.03z" opacity=".3"/><path d="M9.07 7.57C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02zm7.33 9.45c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.79 8.8c-.41-1.21-.67-2.48-.76-3.8h1.5c.07.89.22 1.76.46 2.59L5.79 8.8z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="Video Cal"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 8h10v8H5z" opacity=".3"/><path d="M17 7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7zm-2 9H5V8h10v8z"/></svg></a>
															<a class="option-dots new-list2" data-toggle="dropdown" href="#"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></a>
															<div class="dropdown-menu tx-13 dropdown-menu-right">
																<a class="dropdown-item" href="#">Assigned to</a>
																<a class="dropdown-item" href="#">Mark As Unread</a>
																<a class="dropdown-item" href="#">Mark As Important</a>
																<a class="dropdown-item" href="#">Add to Tasks</a>
																<a class="dropdown-item" href="#">Add Star</a>
																<a class="dropdown-item" href="#">Move to</a>
																<a class="dropdown-item" href="#">Mute</a>
																<a class="dropdown-item" href="#">Move to Trash</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /col -->
									<!-- col -->
									<div class="col-lg-6">
										<div class="card">
											<div class="card-body p-0">
												<div class="chat-widget-header d-flex p-5">
													<div class="font-weight-bold d-flex">
														<img class="avatat avatar-md brround mr-2" src="{{URL::asset('assets/images/users/6.jpg')}}" alt="img">
														<div class="mt-1 d-none d-sm-block">
															<h6 class="font-weight-semibold mb-0">Archie Kesler</h6>
															<small>archiekesler@gmail.com</small>
														</div>
													</div>
													<div class="ml-auto">
														<div class="d-flex">
															<a class="option-dots new-list2" href="#" data-toggle="modal" data-target="#chatmodel" data-placement="top" data-toggle="tooltip" title="Chat"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 4H4v13.17L5.17 16H20V4zm-6 10H6v-2h8v2zm4-3H6V9h12v2zm0-3H6V6h12v2z" opacity=".3"/><path d="M20 18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14zm-16-.83V4h16v12H5.17L4 17.17zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="call"><svg  class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM5.03 5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.23-.84-.38-1.71-.44-2.6H5.03z" opacity=".3"/><path d="M9.07 7.57C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02zm7.33 9.45c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.79 8.8c-.41-1.21-.67-2.48-.76-3.8h1.5c.07.89.22 1.76.46 2.59L5.79 8.8z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="Video Cal"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 8h10v8H5z" opacity=".3"/><path d="M17 7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7zm-2 9H5V8h10v8z"/></svg></a>
															<a class="option-dots new-list2" data-toggle="dropdown" href="#"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></a>
															<div class="dropdown-menu tx-13 dropdown-menu-right">
																<a class="dropdown-item" href="#">Assigned to</a>
																<a class="dropdown-item" href="#">Mark As Unread</a>
																<a class="dropdown-item" href="#">Mark As Important</a>
																<a class="dropdown-item" href="#">Add to Tasks</a>
																<a class="dropdown-item" href="#">Add Star</a>
																<a class="dropdown-item" href="#">Move to</a>
																<a class="dropdown-item" href="#">Mute</a>
																<a class="dropdown-item" href="#">Move to Trash</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /col -->
									<!-- col -->
									<div class="col-lg-6">
										<div class="card">
											<div class="card-body p-0">
												<div class="chat-widget-header d-flex p-5">
													<div class="font-weight-bold d-flex">
														<img  class="avatat avatar-md brround mr-2" src="{{URL::asset('assets/images/users/9.jpg')}}" alt="img">
														<div class="mt-1 d-none d-sm-block">
															<h6 class="font-weight-semibold mb-0">Elizabeth Loux</h6>
															<small>elizabethloux@gmail.com</small>
														</div>
													</div>
													<div class="ml-auto">
														<div class="d-flex">
															<a class="option-dots new-list2" href="#" data-toggle="modal" data-target="#chatmodel" data-placement="top" data-toggle="tooltip" title="Chat"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 4H4v13.17L5.17 16H20V4zm-6 10H6v-2h8v2zm4-3H6V9h12v2zm0-3H6V6h12v2z" opacity=".3"/><path d="M20 18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14zm-16-.83V4h16v12H5.17L4 17.17zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="call"><svg  class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM5.03 5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.23-.84-.38-1.71-.44-2.6H5.03z" opacity=".3"/><path d="M9.07 7.57C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02zm7.33 9.45c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.79 8.8c-.41-1.21-.67-2.48-.76-3.8h1.5c.07.89.22 1.76.46 2.59L5.79 8.8z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="Video Cal"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 8h10v8H5z" opacity=".3"/><path d="M17 7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7zm-2 9H5V8h10v8z"/></svg></a>
															<a class="option-dots new-list2" data-toggle="dropdown" href="#"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></a>
															<div class="dropdown-menu tx-13 dropdown-menu-right">
																<a class="dropdown-item" href="#">Assigned to</a>
																<a class="dropdown-item" href="#">Mark As Unread</a>
																<a class="dropdown-item" href="#">Mark As Important</a>
																<a class="dropdown-item" href="#">Add to Tasks</a>
																<a class="dropdown-item" href="#">Add Star</a>
																<a class="dropdown-item" href="#">Move to</a>
																<a class="dropdown-item" href="#">Mute</a>
																<a class="dropdown-item" href="#">Move to Trash</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /col -->
									<!-- col -->
									<div class="col-lg-6">
										<div class="card">
											<div class="card-body p-0">
												<div class="chat-widget-header d-flex p-5">
													<div class="font-weight-bold d-flex">
														<img  class="avatat avatar-md brround mr-2" src="{{URL::asset('assets/images/users/10.jpg')}}" alt="img">
														<div class="mt-1 d-none d-sm-block">
															<h6 class="font-weight-semibold mb-0">Kathaleen Roysden</h6>
															<small>kathaleenroysden@gmail.com</small>
														</div>
													</div>
													<div class="ml-auto">
														<div class="d-flex">
															<a class="option-dots new-list2" href="#" data-toggle="modal" data-target="#chatmodel" data-placement="top" data-toggle="tooltip" title="Chat"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 4H4v13.17L5.17 16H20V4zm-6 10H6v-2h8v2zm4-3H6V9h12v2zm0-3H6V6h12v2z" opacity=".3"/><path d="M20 18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14zm-16-.83V4h16v12H5.17L4 17.17zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="call"><svg  class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM5.03 5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.23-.84-.38-1.71-.44-2.6H5.03z" opacity=".3"/><path d="M9.07 7.57C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02zm7.33 9.45c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.79 8.8c-.41-1.21-.67-2.48-.76-3.8h1.5c.07.89.22 1.76.46 2.59L5.79 8.8z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="Video Cal"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 8h10v8H5z" opacity=".3"/><path d="M17 7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7zm-2 9H5V8h10v8z"/></svg></a>
															<a class="option-dots new-list2" data-toggle="dropdown" href="#"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></a>
															<div class="dropdown-menu tx-13 dropdown-menu-right">
																<a class="dropdown-item" href="#">Assigned to</a>
																<a class="dropdown-item" href="#">Mark As Unread</a>
																<a class="dropdown-item" href="#">Mark As Important</a>
																<a class="dropdown-item" href="#">Add to Tasks</a>
																<a class="dropdown-item" href="#">Add Star</a>
																<a class="dropdown-item" href="#">Move to</a>
																<a class="dropdown-item" href="#">Mute</a>
																<a class="dropdown-item" href="#">Move to Trash</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /col -->
									<!-- col -->
									<div class="col-lg-6">
										<div class="card">
											<div class="card-body p-0">
												<div class="chat-widget-header d-flex p-5">
													<div class="font-weight-bold d-flex">
														<img  class="avatat avatar-md brround mr-2" src="{{URL::asset('assets/images/users/11.jpg')}}" alt="img">
														<div class="mt-1 d-none d-sm-block">
															<h6 class="font-weight-semibold mb-0">Raisa Ladwig</h6>
															<small>raisaladwig@gmail.com</small>
														</div>
													</div>
													<div class="ml-auto">
														<div class="d-flex">
															<a class="option-dots new-list2" href="#" data-toggle="modal" data-target="#chatmodel" data-placement="top" data-toggle="tooltip" title="Chat"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 4H4v13.17L5.17 16H20V4zm-6 10H6v-2h8v2zm4-3H6V9h12v2zm0-3H6V6h12v2z" opacity=".3"/><path d="M20 18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14zm-16-.83V4h16v12H5.17L4 17.17zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="call"><svg  class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM5.03 5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.23-.84-.38-1.71-.44-2.6H5.03z" opacity=".3"/><path d="M9.07 7.57C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02zm7.33 9.45c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.79 8.8c-.41-1.21-.67-2.48-.76-3.8h1.5c.07.89.22 1.76.46 2.59L5.79 8.8z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="Video Cal"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 8h10v8H5z" opacity=".3"/><path d="M17 7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7zm-2 9H5V8h10v8z"/></svg></a>
															<a class="option-dots new-list2" data-toggle="dropdown" href="#"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></a>
															<div class="dropdown-menu tx-13 dropdown-menu-right">
																<a class="dropdown-item" href="#">Assigned to</a>
																<a class="dropdown-item" href="#">Mark As Unread</a>
																<a class="dropdown-item" href="#">Mark As Important</a>
																<a class="dropdown-item" href="#">Add to Tasks</a>
																<a class="dropdown-item" href="#">Add Star</a>
																<a class="dropdown-item" href="#">Move to</a>
																<a class="dropdown-item" href="#">Mute</a>
																<a class="dropdown-item" href="#">Move to Trash</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /col -->
									<!-- col -->
									<div class="col-lg-6">
										<div class="card">
											<div class="card-body p-0">
												<div class="chat-widget-header d-flex p-5">
													<div class="font-weight-bold d-flex">
														<img  class="avatat avatar-md brround mr-2" src="{{URL::asset('assets/images/users/12.jpg')}}" alt="img">
														<div class="mt-1 d-none d-sm-block">
															<h6 class="font-weight-semibold mb-0">Veronica Kimer</h6>
															<small>veronicakimer@gmail.com</small>
														</div>
													</div>
													<div class="ml-auto">
														<div class="d-flex">
															<a class="option-dots new-list2" href="#" data-toggle="modal" data-target="#chatmodel" data-placement="top" data-toggle="tooltip" title="Chat"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 4H4v13.17L5.17 16H20V4zm-6 10H6v-2h8v2zm4-3H6V9h12v2zm0-3H6V6h12v2z" opacity=".3"/><path d="M20 18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14zm-16-.83V4h16v12H5.17L4 17.17zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="call"><svg  class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM5.03 5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.23-.84-.38-1.71-.44-2.6H5.03z" opacity=".3"/><path d="M9.07 7.57C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02zm7.33 9.45c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.79 8.8c-.41-1.21-.67-2.48-.76-3.8h1.5c.07.89.22 1.76.46 2.59L5.79 8.8z"/></svg></a>
															<a class="option-dots new-list2" href="#" data-placement="top" data-toggle="tooltip" title="Video Cal"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 8h10v8H5z" opacity=".3"/><path d="M17 7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4V7zm-2 9H5V8h10v8z"/></svg></a>
															<a class="option-dots new-list2" data-toggle="dropdown" href="#"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg></a>
															<div class="dropdown-menu tx-13 dropdown-menu-right">
																<a class="dropdown-item" href="#">Assigned to</a>
																<a class="dropdown-item" href="#">Mark As Unread</a>
																<a class="dropdown-item" href="#">Mark As Important</a>
																<a class="dropdown-item" href="#">Add to Tasks</a>
																<a class="dropdown-item" href="#">Add Star</a>
																<a class="dropdown-item" href="#">Move to</a>
																<a class="dropdown-item" href="#">Mute</a>
																<a class="dropdown-item" href="#">Move to Trash</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /col -->
								</div>
							</div>
						</div>

					</div>
				</div><!-- end app-content-->
			</div>
@endsection
@section('js')
@endsection