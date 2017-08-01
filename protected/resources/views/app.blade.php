<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LG G5 &amp; Friends</title>
        <link rel="icon" type="image/x-icon" href="{{url('/')}}/assets/images/favicons/favicon.ico" />
        <link rel="icon" type="image/png" href="{{url('/')}}/assets/images/favicons/favicon.png" />
        <!-- For iPhone 4 Retina display: -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{url('/')}}/assets/images/favicons/apple-touch-icon-114x114-precomposed.png">
        <!-- For iPad: -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{url('/')}}/assets/images/favicons/apple-touch-icon-72x72-precomposed.png">
        <!-- For iPhone: -->
        <link rel="apple-touch-icon-precomposed" href="{{url('/')}}/assets/images/favicons/apple-touch-icon-60x60-precomposed.png">
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{url('/')}}/assets/css/bootstrap.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/theme.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/color-defaults.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-beige-black.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-black-beige.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-black-white.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-black-yellow.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-blue-white.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-green-white.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-red-white.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-white-black.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-white-blue.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-white-green.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-white-red.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/swatch-yellow-black.css">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/fonts.css" media="screen">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/revolution.css" media="screen">

        <!-- LG Smart Font -->
        <link rel="stylesheet" href="{{url('/')}}/assets/fonts/lg-smart/stylesheet.css" media="screen">        

        <!-- Vertical Navigation -->
        <link rel="stylesheet" href="{{url('/')}}/assets/css/vertical-navigation.css" media="screen">
    </head>
    <body>
        <header id="masthead" class="navbar swatch-red-white" role="banner">
            <!-- <div class="container"> -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".main-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="../index.html" class="navbar-brand">
                        <img src="{{url('/')}}/assets/images/LG-G5_logo.png" alt="LG G5 and Friends">
                    </a>
                </div>
                <nav class="collapse navbar-collapse main-navbar" role="navigation">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li class=""><a href="#home">Home</a>
                        </li> -->
                        <li class=""><a href="#"><img src="{{url('/')}}/assets/images/LG_lifesgood.png" alt="LG - Life's Good"></a>
                        </li>
                    </ul>
                </nav>
            <!-- </div> -->
        </header>

       @yield('content')
	   
	   
        <a class="go-top" href="javascript:void(0)">
            <i class="fa fa-angle-up"></i>
        </a>
        <script src="{{url('/')}}/assets/js/packages.min.js"></script>
        <script src="{{url('/')}}/assets/js/theme.min.js"></script>
        

        <!-- Vertical Navigation -->
        <script src="{{url('/')}}/assets/js/vertical-navigation.js"></script>
        <script src="{{url('/')}}/assets/js/modernizr.js"></script>
    </body>
</html>



