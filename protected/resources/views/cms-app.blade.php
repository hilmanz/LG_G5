<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>BMWxMANUAL</title>
	<link rel="icon" href="{{url('/')}}/images/favicon/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"></link> 
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="icon" href="{{url('/')}}/admin/images/favicon-2.png" type="image/x-icon">

	<link href="{{url('/')}}/admin/css/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/admin/css/colpick.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/admin/css/admin-shinkenjuku.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/admin/css/responsive.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="{{url('/')}}/admin/css/atooltip.css" rel="stylesheet"  media="screen" />

	<style>
		#textcontent{width:100px; height: 100px;} 
	</style>

	<!-- // IE  // -->
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
    
    <script type="text/javascript" src="{{url('/')}}/admin/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/admin/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/jquery.atooltip.js"></script>
    <script src="{{url('/')}}/admin/js/sweetalert.min.js" type="text/javascript"></script>
	<script src="{{url('/')}}/admin/js/sweetalert.min.js"></script>
	<!-- JS library -->
	<script>
		var basedomain = "{{url('/')}}" ;
		var basedomainpath = "{{url('/')}}" ;
		var pages = "{$pages}" ;
	</script> 
	<!--- END ---->
<script type="text/javascript" src="{{url('/')}}/admin/jscripts/tiny_mce/tiny_mce.js"></script>
<script src="{{url('/')}}/admin/js/ckeditor2/ckeditor.js"></script>	
<script type="text/javascript" src="{{url('/')}}/admin/js/tinymce/js/tinymce/tinymce.min.js"></script>
<!--
<script language="javascript" type="text/javascript" src="{{url('/')}}/admin/js/tinymce/FileBrowser.js"></script>
<script language="javascript" type="text/javascript" src="{{url('/')}}/admin/js/tinymce/FileChooser.js"></script>
<script  language="javascript" type="text/javascript" src="{{url('/')}}/admin/js/tinymce/ImageChooser.js"></script>
-->
	<script type="text/javascript" src="{{url('/')}}/admin/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="{{url('/')}}/admin/js/jquery.easing.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/jquery.steps.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/jquery.magnific-popup.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/colpick.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/php.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/jquery.form.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/kipagination.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/contentviews.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/contentHelper.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/touchbase.js"></script>
    <script src="{{url('/')}}/admin/js/highcharts.js"></script>
    <script src="{{url('/')}}/admin/js/modules/exporting.js"></script>
	 <script type="text/javascript" src="{{url('/')}}/admin/js/validationkana.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $("#datepicker").datepicker({dateFormat:"yy-mm-dd"});
        }); 

    </script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
</head>


<body>
  <div id="body">
    <div id="page">
      <div id="sidebar">
        <div id="navbar">
            <ul>
				<li><a href="{{url('/')}}/cms/article"><span class="icon-home">&nbsp;</span><span>Home</span></a></li>				
                <li><span class="icon-file">&nbsp;</span><span>Article</span>
					<ul>
						<li><a href="{{url('/')}}/cms/list-article" ><span class="icon-file">&nbsp;</span><span>Main Slider</span></a></li>
						<li><a href="{{url('/')}}/cms/detail-article" ><span class="icon-file">&nbsp;</span><span>Articles Content</span></a></li>
					</ul>
				</li>
				<li><a href="{{url('/')}}/cms/city-tour" ><span class="icon-file">&nbsp;</span><span>City Tour</span></a></li>				
				<li><a href="{{url('/')}}/cms/user" ><span class="icon-file">&nbsp;</span><span>User</span></a></li>
                <li><a href="{{url('/')}}/cms/logout" ><span class="icon-lock">&nbsp;</span><span>Logout </span></a></li>		
              </ul>
          </div>
      </div><!-- end #sidebar -->
        <div id="thecontent">
			 <!-- Note: this file is only intended for development use! -->
 
        <div class="sweet-overlay"></div>
 
 
        
			@yield('content')
        </div><!-- /#thecontent -->

		  <div id="top">

	<div class="wrapper menuHeader"> 		
		<a class="logo" href="{{url('/')}}/cms/article">  <img height="55px" src="{{url('/')}}/admin/images/logo-login.png" >   </a>
		<div style="float:left;">
		</div><!-- end .wrapper -->      
	</div><!-- end #top --> 

    </div><!-- end #page -->
  </div><!-- end #body -->    
</body>
</html>