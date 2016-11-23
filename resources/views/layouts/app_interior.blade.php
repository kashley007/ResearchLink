<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ODU - ResearchLink | </title>

        <!-- Bootstrap -->
        <link href="{{ asset("vendors/bootstrap/dist/css/bootstrap.min.css")}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset("vendors/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset("vendors/nprogress/nprogress.css")}}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{ asset("vendors/iCheck/skins/flat/green.css")}}" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="{{ asset("vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css")}}" rel="stylesheet">
        <!-- JQVMap -->
        <link href="{{ asset("vendors/jqvmap/dist/jqvmap.min.css")}}" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="{{ asset("vendors/bootstrap-daterangepicker/daterangepicker.css") }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset("fonts/css/font-awesome.min.css") }}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset("css/interiortemplate.css") }}" rel="stylesheet">
        <link href="{{ asset("css/researchlink.css") }}" rel="stylesheet">
        <!-- Switchery -->
        <link href="{{ asset("vendors/switchery/dist/switchery.min.css") }}" rel="stylesheet">


        @stack('stylesheets')

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                @include('includes/sidebar')

                @include('includes/topbar')

                @yield('main_container')

            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset("vendors/jquery/dist/jquery.min.js")}}"></script>
        <!-- jQuery Smart Wizard -->
        <script src="{{ asset("vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js")}}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset("vendors/bootstrap/dist/js/bootstrap.min.js")}}"></script>
        <!-- FastClick -->
        <script src="{{ asset("vendors/fastclick/lib/fastclick.js")}}"></script>
        <!-- NProgress -->
        <script src="{{ asset("vendors/nprogress/nprogress.js")}}"></script>
        <!-- Chart.js -->
        <script src="{{ asset("vendors/Chart.js/dist/Chart.min.js")}}"></script>
        <!-- gauge.js -->
        <script src="{{ asset("vendors/gauge.js/dist/gauge.min.js")}}"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{ asset("vendors/bootstrap-progressbar/bootstrap-progressbar.min.js")}}"></script>
        <!-- iCheck -->
        <script src="{{ asset("vendors/iCheck/icheck.min.js")}}"></script>
        <!-- Skycons -->
        <script src="{{ asset("vendors/skycons/skycons.js")}}"></script>
        <!-- Flot -->
        <script src="{{ asset("vendors/Flot/jquery.flot.js")}}"></script>
        <script src="{{ asset("vendors/Flot/jquery.flot.pie.js")}}"></script>
        <script src="{{ asset("vendors/Flot/jquery.flot.time.js")}}"></script>
        <script src="{{ asset("vendors/Flot/jquery.flot.stack.js")}}"></script>
        <script src="{{ asset("vendors/Flot/jquery.flot.resize.js")}}"></script>
        <!-- Flot plugins -->
        <script src="{{ asset("vendors/flot.orderbars/js/jquery.flot.orderBars.js")}}"></script>
        <script src="{{ asset("vendors/flot-spline/js/jquery.flot.spline.min.js")}}"></script>
        <script src="{{ asset("vendors/flot.curvedlines/curvedLines.js")}}"></script>
        <!-- DateJS -->
        <script src="{{ asset("vendors/DateJS/build/date.js")}}"></script>
        <!-- JQVMap -->
        <script src="{{ asset("vendors/jqvmap/dist/jquery.vmap.js")}}"></script>
        <script src="{{ asset("vendors/jqvmap/dist/maps/jquery.vmap.world.js")}}"></script>
        <script src="{{ asset("vendors/jqvmap/examples/js/jquery.vmap.sampledata.js")}}"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{ asset("vendors/moment/min/moment.min.js")}}"></script>
        <script src="{{ asset("vendors/bootstrap-daterangepicker/daterangepicker.js")}}"></script>
        <!-- Switchery -->
        <script src="{{ asset("vendors/switchery/dist/switchery.min.js")}}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset("js/custom.js") }}"></script>
        <!-- Select Multiple in box w/o using ctrl -->
        <script src="{{ asset("js/multiSelect.js") }}"></script>
        
        

        @stack('scripts')
        
        <script>
        $(document).ready(function() {
            

            if(window.location.pathname == '/home') {
            
                $('.main_container').fadeIn(1100).delay(2000);
    
            }else{
                $('.main_container').css("display", "block");
            }

            $('#wizard').smartWizard();

            $('#wizard_verticle').smartWizard({
              transitionEffect: 'slide'
            });

            $('.buttonNext').addClass('btn btn-success');
            $('.buttonPrevious').addClass('btn btn-primary');
            $('.buttonFinish').addClass('btn btn-default');
        });
    </script>
    </body>
</html>