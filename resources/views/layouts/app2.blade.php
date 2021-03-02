<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--<title>{{ config('app.name', 'Bienvenido a InnovaDent Huetamo') }}</title>-->
    <title>Bienvenido a CEA payment system</title>
    <!-- Scripts -->
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    

    <!-- ASSETS CSS INSPINIA -->

    <link href="{{asset('css/bootstrap.min.css')}}  " rel="stylesheet">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">-->
    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{asset('js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">
    <!--CHOOSEN SELECT-->
    <link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/switchery/switchery.css')}}" rel="stylesheet">


    <!--  SCRIPTS INSPINIA  -->

 <!-- Mainly scripts -->
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Flot -->
    <script src="{{asset('js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.pie.js')}}"></script>

    <!-- Peity -->
    <script src="{{asset('js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/demo/peity-demo.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('js/inspinia.js')}}"></script>
    <script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>

    <!-- jQuery UI -->
    <script src="{{asset('js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- GITTER -->
    <script src="{{asset('js/plugins/gritter/jquery.gritter.min.js')}}"></script>

    <!-- Sparkline -->
    <script src="{{asset('js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{asset('js/demo/sparkline-demo.js')}}"></script>

    <!-- ChartJS-->
    <script src="{{asset('js/plugins/chartJs/Chart.min.js')}}"></script>

    <!-- Toastr -->
    <script src="{{asset('js/plugins/toastr/toastr.min.js')}}"></script>

    <script src="{{asset('js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>

    <script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

    <script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>

    <!-- Data picker -->
   <script src="{{asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

   <!-- Switchery -->
   <script src={{asset('js/plugins/switchery/switchery.js')}}></script>

   <!-- Sweet alert -->
   <script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>

</head>
<body>
    <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element"> <div style="width:50px; height:56px;">
                                <img alt="image" class="img-circle" style="width:100%;" src="{{Auth::user()->user_photo ? asset(Auth::user()->user_photo) : asset('img/profile.jpg')}}">
                                </div>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"></strong>
                                </span> <span class="text-muted text-xs block"> <b class="caret"></b></span> </span> </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <!--<li><a href="profile.html">Perfil</a></li>-->
                                    <li>
                                        <a  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                        >
                                             {{ __('Cerrar Sesión') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                IDH
                            </div>
                        </li>
                        <li>
                            <a href="{{ url('/home') }}"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span></a>
                        </li>
                        @if(auth()->user()->role->id == 1)
                        <li>
                            <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Personal</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="/users/cashier/index">Cajeros</a></li>
                                <li><a href="/users/admin/index">Administradores</a></li>
                            </ul>
                        </li>
                        @endif
                        <li>
                            <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Operaciones</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="/alumno">Alumnos</a></li>
                                <li><a href="/movimientos">Pagos</a></li>
                                <li><a href="/adeudos">Adeudos</a></li>

                                @if(auth()->user()->role->id == 1)
                                    <li><a href="/earning">Corte de Caja</a></li>
                                    <!--<li><a href="/movements">Movimientos caja</a></li>-->
                                @endif
                            </ul>
                        </li>
                        @if(auth()->user()->role->id == 1)
                        <li>
                            <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Administración</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="/tipoInscripcion">Tipo de Inscripción</a></li>
                                <li><a href="/modalidad">Modalidades</a></li>
                                <li><a href="/carrera">Oferta educativa</a></li>
                                <li><a href="/concepto">Conceptos de pago</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>

                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg bck-square dashbard-1">
                @yield('spinner')

                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <!--<form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>-->
                    </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a  href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-sign-out"></i> {{ __('Cerrar Sesión') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                </form>
                            </li>
                        </ul>

                    </nav>
                </div>
                <!-- Main content-->
                <div class="wrapper wrapper-content">
                <main class="py-4">
                    @yield('content')
                </main>
                

                </div>
                <!-- END Main content-->

            </div><!--END PAGE-WRAPPER-->
    </div><!--END WRAPPER-->



    <script>
        $(document).ready(function(){
            @yield('disbutton')
            @yield('switchery')
            

            var today=new Date();
            $('#dc .dc-date .dci').datepicker({
                            dateFormat: 'DD-MM',
                            changeMonth: true,
                            changeYear: true
                    }).datepicker('setDate', new Date(today.getFullYear(), today.getMonth(), today.getDate()));


            $('.chosen-select').chosen({width: "100%"});
            $('.filter').hide();
            var pivote = 0;
            $( "#filter" ).click(function() {
                if(pivote == 0){
                    $('.datepicker').attr('required');
                    $('.filter').fadeIn();
                    
                    $('#data_5 .input-daterange .datepicker').datepicker({
                            dateFormat: 'dd-mm-yyyy',
                            changeMonth: true,
                            changeYear: true
                    }).datepicker('setDate', new Date(today.getFullYear(), today.getMonth(), today.getDate()));
                    pivote = 1;
                }else{
                    $('.datepicker').removeAttr('required');
                    $('.filter').fadeOut();
                    $('#data_5 .input-daterange .datepicker').datepicker('setDate', null);
                    pivote = 0;
                }
                
            
            });            
    });

    </script>

    @yield('additional_scripts')

</body>
</html>
