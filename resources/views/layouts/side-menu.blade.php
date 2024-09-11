<!--aside open-->
<div class="app-sidebar app-sidebar2">
					<div class="app-sidebar__logo">
						<a class="header-brand" href="{{ route('index') }}">
							<!-- <img src="{{URL::asset('assets/images/brand/logo.png')}}" style="height: 3.8rem"  class="header-brand-img desktop-lgo" alt="Covido logo"> -->
							<img src="{{URL::asset('assets/images/brand/logo1.png')}}" class="header-brand-img dark-logo" alt="Covido logo">
							<img src="{{URL::asset('assets/images/brand/favicon.png')}}" class="header-brand-img mobile-logo" alt="Covido logo">
							<img src="{{URL::asset('assets/images/brand/favicon1.png')}}" class="header-brand-img darkmobile-logo" alt="Covido logo">
						</a>
					</div>
				</div>
				<aside class="app-sidebar app-sidebar3">
					<div class="app-sidebar__user">
						<div class="dropdown user-pro-body text-center">
							<div class="user-pic">
								@if (Auth::user())
								<img src="{{ asset('img/profile/1608069288perfil-empresario-dibujos-animados_18591-58479.jpg') }}" alt="user-img" class="avatar-xl rounded-circle mb-1">

								@endif
							</div>
							<div class="user-info">
								@if (Auth::user())
								<h5 class=" mb-1 font-weight-bold">{{ Auth::user()->name }} 
								</h5>
								@endif
							
								{{-- <span class="text-muted app-sidebar__user-name text-sm">App de Inventario</span> --}}
							</div>
						</div>
					</div>
                    <ul class="side-menu">
						<li class="slide">
                            <a class="side-menu__item" href="{{ route('dashboardgrap') }}">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hor-icon"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                <span class="side-menu__label">Inicio</span><i class="side-menu__icon angle fa fa-angle-right"></i>
                            </a>
                        </li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                <span class="side-menu__label">Inventario</span><i class="side-menu__icon angle fa fa-angle-right"></i>
                            </a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="{{ route('inventario.indexVenta') }}"><span>Inventario de productos de Venta</span></a></li>
								<li><a class="slide-item" href="{{ route('venta.index') }}"><span>Registro de Ventas</span></a></li>
								<li><a class="slide-item" href="{{ route('inventario.indexAlquiler') }}"><span>Inventario de productos de Alquiler</span></a></li>
								<li><a class="slide-item" href="{{ route('alquiler.index') }}"><span>Registro de Alquileres</span></a></li>
								<li><a class="slide-item" href="{{ route('cliente.index') }}"><span>Clientes</span></a></li>

							</ul>
						</li>
				
						@if(Auth::user()->isAdmin())
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
									<svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
									<span class="side-menu__label">Administracion</span><i class="side-menu__icon angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li><a class="slide-item" href="{{route('divisas.create')}}"><span>Divisas</span></a></li>
									@if( Auth::user()->isSuper())
										<li><a href="{{ route('users.index') }}" class="slide-item"><span>Usuarios</span></a></li>
										<li><a href="{{ route('empleado.index') }}" class="slide-item"><span>Nomina de empleados</span></a></li>
										<li><a href="{{ route('gasto.index') }}" class="slide-item"><span>Gastos diarios</span></a></li>
										<li><a href="{{ route('ingreso.index') }}" class="slide-item"><span>Ingresos diarios</span></a></li>
										<li><a href="{{ route('cierre.index') }}" class="slide-item"><span>Cierres</span></a></li>
										<li><a href="{{ route('contabilidad.index') }}" class="slide-item"><span>Contabilidad</span></a></li>
										<li><a href="{{ route('oferta.index') }}" class="slide-item"><span>Promociones</span></a></li>
										<li><a href="{{ route('intercambio.index') }}" class="slide-item"><span>Intercambios</span></a></li>
									@endif
								</ul>
							</li>
						@endif


				
				</aside>

