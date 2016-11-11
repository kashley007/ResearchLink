<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ResearchLink</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{URL::asset('/css/exterior.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/slick/slick-theme.css')}}"/>
    

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <div class="container" id="Logo">
        <div class="row">
            <div id="left_header" class="col-sm-6 col-xs-12">
                <img src="{{URL::asset('/images/ODULogo.jpg')}}">
            </div>
            <div id="right_header" class="col-sm-6 col-xs-12">
                <p>
                    "<span class="header_text_span">Our</span> philosophy is simple: Knowledge should be productive. 
                    We are committed to providing research-driven solutions. 
                    Our world-class researchers are partnering with business, industry, 
                    government and investment leaders to create answers for society's most pressing challenges."
                </p>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                @if (Auth::guest())
                    <a id="brandLink" class="navbar-brand" href="{{ url('/') }}">
                        ResearchLink
                    </a>
                @else
                    <a id="brandLink" class="navbar-brand" href="{{ url('/home') }}">
                        ResearchLink
                    </a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script type="text/javascript" src="{{URL::asset('/slick/slick.min.js')}}"></script>
    
    <script>
        $(document).ready(function() {
            $('.panel-body').fadeIn(1100).delay(2000);

            $('.newsreel').slick({
                
                autoplay: true,
                autoplaySpeed: 4000,
            });

            if(window.location.pathname == '/') {
            
                $('#right_header p').fadeIn(1100).delay(2000);
                $('#left_header img').fadeIn(1100).delay(2000);
            }else{
                $('#right_header p').css("display", "block");
                $('#left_header img').css("display", "block");
            }
        });
    </script>
</body>
</html>
