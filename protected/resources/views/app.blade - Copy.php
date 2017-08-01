<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


<!-- =========================
      BASIC PAGE INFORMATION
============================== -->

	@if($pages=='coverage')
		 <title>Manual X BMW | ISSUE</title>
	@else
		 <title>Manual X BMW</title>
	@endif

    <meta name="description" content="Manual X BMW in search of an elusive shortcut. Discussion forum initiated by Manual Jakarta to provide a platform for the public to voice out their ideas. This platform aims to narrow down the gap between our publication and the readers">


    <meta name="keywords" content="Manual, BMW">
    <meta name="author" content="mybmw.co.id">

    <!-- ALLOW GOOGLE TO INDEX YOUR PAGE -->
    <META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">


<!-- =========================
      FAV & TOUCH ICONS
============================== -->
    <!-- FAVICON FOR DESKTOPS -->
    <link rel="icon" href="images/favicon/icon_drive.png">

    <!-- SET OF FAVICONS FOR APPLE PRODUCTS -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">


<!-- =========================
     FONTS
============================== -->
    <!-- EB Garamond GOOGLE -->
    <link href='https://fonts.googleapis.com/css?family=EB+Garamond' rel='stylesheet' type='text/css' />

    <!-- EB GARAMOND from Font Library - https://fontlibrary.org/en/font/eb-garamond -->
    <!-- <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/eb-garamond" type="text/css"/> -->

    <!-- ELEGANT ICON PACK -->
    <link href="css/icons/elegant.css" rel='stylesheet' type='text/css'>


<!-- =========================
     MAIN STYLESHEETS
============================== -->
    <!-- BOOTSTRAP -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet">

    <!-- MANUAL X BMW -->
    <link href="css/style.css" rel="stylesheet">

    <!-- CAROUSEL -->
   
	@if($pages=='coverage')
		  <!--link href="css/plugins/plugins.css" rel="stylesheet"-->
	@else
		  <link href="css/plugins/plugins.css" rel="stylesheet">
	@endif

    <!-- SESSION CAPTION -->
    <link href="css/caption.css" rel="stylesheet">


<!-- =========================
     ANIMATIONS
============================== -->
    <!-- ANIMATIONS BASED ON ANIMATE.CSS -->
    <link href="css/animations/animations.css" rel="stylesheet" type="text/css">

<!-- =========================
     SLIDER
============================== -->
  <!-- <link rel="stylesheet" type="text/css" href="css/slider.css" />
  <link rel="stylesheet" type="text/css" href="css/slider-responsive.css" /> -->
  <link rel="stylesheet" type="text/css" href="vendors/slider/css/slider.css" />
  <link rel="stylesheet" type="text/css" href="vendors/slider/css/style-responsive.css" />

  
<!-- =========================
     INTERNET EXPLORER FIXES
============================== -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>


<body id="body" class="page-loading">

<!-- =========================
     PRELOADER
============================== -->
    <div id="preloader">
        <div id="loading"></div>
    </div>


<!-- =========================
     MAIN MENU
============================== -->
	@if($pages=='coverage')
		<nav id="mainmenu" class="navbar navbar-fixed-top main-menu coverage head-menu auto-height" role="navigation">
	@else
		 <nav id="mainmenu" class="navbar navbar-fixed-top main-menu head-menu auto-height" role="navigation">
	@endif
        <div class="container">
            
            <!-- LOGO CONTAINER -->
            <div class="logo-cont">
                <a class="navbar-brand" href="{{url('/home')}}">
                    <img src="images/logo_manualXbmw.png" alt="Manual X BMW">    
                </a> 
            </div>
            
            <!-- "BURGER MENU" FOR RESPONSIVE VIEW -->
            <div class="navbar-header" id="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            
            <!-- MAIN MENU CONTAINER -->
            <div id="navbar" class="navbar-collapse collapse">
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                      
                         <li><a href="{{url('/home')}} ">Home</a></li>
                        <li><a href="{{url('/about')}} ">About</a></li>                       
                        <li><a href="{{url('/fashion_issue')}}">Issue</a></li>
                        <!-- <li><a href="#">City Tour</a></li> -->
                        
                    </ul>
                </div>
            </div>
            
        </div>
    </nav>
 
@yield('content')

<!-- =========================
     FOOTER
============================== -->
    <footer>
      <div class="container anim-fade-down">
        <div class="row">
          <div class="col-md-2 col-sm-3 col-xs-6 weblink">
            <a href="http://www.mybmw.co.id" target="_blank">www.mybmw.co.id</a>
          </div>
          <div class="col-md-2 col-sm-3 col-xs-6 weblink">
            <a href="http://www.manual.co.id" target="_blank">www.manual.co.id</a>
          </div>
        <!-- SOCIAL MEDIA -->
        <div class="col-md-8 col-sm-6 col-xs-12">

            <!-- FACEBOOK -->
            <a href="https://www.facebook.com/bmw.indonesia" target="_blank">
                <div class="sm">
                    <span class="elegant social_facebook"></span>
                </div>
            </a>

            <!-- TWITTER -->
            <a href="https://twitter.com/BMW_indonesia" target="_blank">
                <div class="sm">
                    <span class="elegant social_twitter"></span>
                </div>
            </a>

            <!-- INSTAGRAM -->
            <a href="http://www.instagram.com/bmw_indonesia" target="_blank">
                <div class="sm">
                    <span class="elegant social_instagram"></span>
                </div>
            </a>

            <!-- COPYRIGHT -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <p class="copyright">Copyright © 2016. All rights reserved.</p>
              </div>
            </div>
        </div><!-- /.col-md-5 -->
           
        </div><!-- /.row -->

          
        </div><!-- /.container -->
    </footer>


<!-- =========================
     JS SCRIPTS
============================== -->
    <!-- JQUERY -->
    <script type="text/javascript" src="js/jquery_1.11.1.min.js"></script>

    <!-- BOOTSTRAP SCRIPTS -->
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <!-- SMOOTH SCROLLING FIX -->
    <script type="text/javascript" src="js/smoothscroll.js"></script>

    <!-- PARALLAX -->
    <script type="text/javascript" src="js/parallax.js" id="parallax-change"></script>

    <!-- HEADROOM -->
    <script type="text/javascript"  src="js/headroom.min.js"></script>
    <script type="text/javascript"  src="js/jQuery.headroom.js"></script>

    <!-- VIEWPORT DETECTION -->
    <script type="text/javascript" src="js/jquery.inview.min.js"></script>

    <!-- CAROUSEL -->
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>

    <!-- COUTNUP -->
    <script type="text/javascript" src="js/countUp.min.js"></script>

    <!-- FORM VALIDATION -->
    <script type="text/javascript" src="js/validator.js"></script>

    <!-- IMAGE ZOOM - COLORBOX JS-->
    <script type="text/javascript" src="js/jquery.colorbox-min.js"></script>

    <!-- SESSION CAPTION JS-->
    <script type="text/javascript" src="js/modernizr.custom.js"></script>
    <script type="text/javascript" src="js/toucheffects.js"></script>

    <!--MANUAL X BMW SCRIPTS & SETTINGS -->
    <script type="text/javascript" src="js/bmwxmanual.scripts.js"></script>


	<script>
	setTimeout(function(){
	 $('.loaderbox').attr('style','display:none');
								
	},2000);
	</script>



	<script>
	$('#phone').keyup(function () {  	
			if(this.value){
				this.value = this.value.replace(/[^0-9]/g,''); 
			}
		});	
	$(document).on('click','.submitevent',function(){
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,15})+$/; 
		var basedomain = "{{url('/')}}" ;	
		var valid='';
			if($('#name').val()=='')
			{	
				valid='ada';
			}
			if($('#email').val()=='')
			{		
				valid='ada';
			}else if(!$('#email').val().match(mailformat))  
				{  		
					valid='ada';
				} 
			if($('#phone').val()=='')
			{
				valid='ada';
			}		
		
		
			if(valid)
			{	
				
				return true;
			}
			else
			{
			var name=$('#name').val();
			var email=$('#email').val();
			var tlpn=$('#phone').val();
			  $.ajax({
					'type': 'POST',
					'url': basedomain+'/home/updatecontact',
					'data': {email:email,nama:name,tlpn:tlpn},
					'dataType':'json',
					'success': function(result){
						$('#name').val('');
						$('#email').val('');
						$('#phone').val('');
						$('#FormSuccess').modal();
					}
				});
			}
					
			//return true;
	});

	</script>

</body>


</html>
