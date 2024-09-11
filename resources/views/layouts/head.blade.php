<!-- Title -->
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--Favicon -->
{{-- <link rel="icon" href="{{URL::asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/> --}}
<!-- Bootstrap css -->
<link href="{{URL::asset('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
<!-- Style css -->
<link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet" />
<!-- Dark css -->
{{-- <link href="{{URL::asset('assets/css/dark.css')}}" rel="stylesheet" /> --}}
<!-- Skins css -->
{{-- <link href="{{URL::asset('assets/css/skins.css')}}" rel="stylesheet" /> --}}
<!-- Animate css -->
<link href="{{URL::asset('assets/css/animated.css')}}" rel="stylesheet" />
<!--Sidemenu css -->
<link id="theme" href="{{URL::asset('assets/css/sidemenu.css')}}" rel="stylesheet">
<!-- P-scroll bar css-->
<link href="{{URL::asset('assets/plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet" />
<!-- Prism Css -->
{{-- <link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet"> --}}
<!---Icons css-->
<link href="{{URL::asset('assets/plugins/web-fonts/icons.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/web-fonts/plugin.css')}}" rel="stylesheet" />
<style>
           #alert-container {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 1000;
                text-align: center;
                pointer-events: none; /* Permite hacer clic a través del contenedor */

            }

            .alert {
                display: inline-block;
                margin: 10px auto;
                padding: 15px;
                border: 1px solid transparent;
                border-radius: 4px;
                background-color: #f2dede;
                color: #a94442;
                border-color: #ebccd1;
                transition: opacity 0.5s ease;
                opacity: 1;
                pointer-events: all; /* Habilita clics solo en la alerta */

            }

            .alert.hidden {
                opacity: 0;
            }

        </style>
@yield('css')
