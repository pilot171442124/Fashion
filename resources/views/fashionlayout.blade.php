<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ config('app.name') }} - @yield('titlename')</title>
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- favicon icon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/images/favicon.ico') }}">
        <!-- google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,800" rel="stylesheet">

 


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  



        <link href="{{ asset('public/css/formdesign.css') }}" rel="stylesheet"> 


        <!-- normalize css -->
        <link href="{{ asset('public/css/normalize.css') }}" rel="stylesheet">
        <!-- bootstrap css -->
     
        <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
      


        <!-- bootstrap css -->
        <link href="{{ asset('public/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <!-- et-line css -->
        <link href="{{ asset('public/css/et-line.css') }}" rel="stylesheet">
        <!-- font awesome css -->
        <link href="{{ asset('public/css/font-awesome.min.css') }}" rel="stylesheet">      
        <!-- meanmenu css -->
        <link href="{{ asset('public/css/meanmenu.css') }}" rel="stylesheet">
        <!-- owl.carousel css -->
        <link href="{{ asset('public/css/owl.carousel.min.css') }}" rel="stylesheet">
        <!-- magnific popup css -->
        <link href="{{ asset('public/css/magnific-popup.css') }}" rel="stylesheet">
        <!-- animate css -->
        <link href="{{ asset('public/css/animate.css') }}" rel="stylesheet">
        <!-- global css -->
        <link href="{{ asset('public/css/global.css') }}" rel="stylesheet">
        <!-- shortcode css -->
        <link href="{{ asset('public/css/shortcode/shortcodes.css') }}" rel="stylesheet">

         <link href="{{ asset('public/css/jquery-confirm.css') }}" rel="stylesheet"> 
        <!-- Toastr -->
         <link href="{{ asset('public/libs/toastr.min.css') }}" rel="stylesheet">
        <!-- style css -->
        <link href="{{ asset('public/css/indexstyle.css') }}" rel="stylesheet">
        <!-- responsive css -->
        <link href="{{ asset('public/css/responsive.css') }}" rel="stylesheet">
         <!-- Chosen -->
        <link href="{{ asset('public/libs/bootstrap-chosen.css') }}" rel="stylesheet"> 
        <!-- normalize js -->
        <link href="{{ asset('public/css/xzoom.min.css') }}" rel="stylesheet">
        
        <link href="{{ asset('public/css/updateanimate.css') }}" rel="stylesheet"> 
        <link href="{{ asset('public/css/jquery-ui.css') }}" rel="stylesheet"> 
        <link href="{{ asset('public/slick/slick/slick.css') }}" rel="stylesheet"> 
<link href="{{ asset('public/slick/slick/slick-theme.css') }}" rel="stylesheet"> 
<!-- for slide-->
       
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">     
       
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>     
 
       
       
       
       
       
       
       
       
        <script src="{{ asset('public/js/vendor/modernizr-3.6.0.min.js') }}" crossorigin="anonymous"></script>
       
    </head>
    <body>
        <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
        
        <!-- Add your site or application content here -->
        <!-- Preloader -->
        <div class="page-loader">
            <div class="loader">Loading...</div>
        </div>
        <!-- /Preloader -->
         <!-- scrollToTop -->   
         <a href="#top" class="scroll-to-top">
            <i class="fa fa-arrow-up"></i>
        </a>
        <!-- /scrollToTop -->
        
        <!-- header -->
        @include('fashionheader')
        <!-- /header -->








        <main>
            @yield('maincontent')
        </main>








        <!-- /Footer Section -->



        <footer>
    <div class="footer-top-are  ptb-60"style="background-color:rgb(100, 100, 60);">

		<!-- Contact info Section -->
		<section class="contact" >
			<div class="container " >
				<div class="row" >

					<div class="col-lg-8" style=" color:white;">
						<div>
							<h4 style="color: white;">Important information of our office</h4>
							<ul>
								<li>
									<span style="float:left; padding-right: 10px;">
										<i class="fa fa-map-marker"></i>
									</span>
									<div>
										House/Holding No-A/66, Word No-05, Dhanmondi, Thanastand, Dhaka
									</div>
								</li>
								<li>
									<span style="float:left; padding-right: 10px;">
										<i class="fa fa-envelope"></i>
									</span>
									<div>
                                    juwelcj248@gmail.com
									</div>
								</li>
								<li>
									<span style="float:left; padding-right: 10px;">
										<i class="fa fa-phone"></i>
									</span>
									<div >
										01764806248
									</div>
								</li>
								<li>
									<span style="float:left; padding-right: 10px;">
										<i class="fa fa-clock-o"></i>
									</span>
									<div >
										Working Hours: 9.00 AM - 6.00 PM Sat - Thu
									</div>
								</li>
							</ul>
						</div>
					</div>

					
					
					<div class="col-lg-4" style=" color:white;">
						<div>
							<h4 style="color: white;">Our Social media Address</h4>
							<ul>
								<li>
									<span style="float:left; padding-right: 10px;">
										<i class="fab fa-facebook-f"></i>
									</span>
									<div>
										<a style="color: white;" href="https://www.facebook.com" target="_blank">Facebook</a>
									</div>
								</li>
								<li>
									<span style="float:left; padding-right: 10px;">
										<i class="fab fa-youtube"></i>
									</span>
									<div>
										<a style="color: white;" href="https://www.youtube.com" target="_blank">Youtube</a>
									</div>
								</li>
								<li>
									<span style="float:left; padding-right: 10px;">
										<i class="fab fa-instagram"></i>
									</span>
									<div>
										<a style="color: white;" href="https://www.instagram.com" target="_blank">Instagram</a>
									</div>
								</li>
								<li>
									<span style="float:left; padding-right: 10px;">
										<i class="fab fa-linkedin"></i>
									</span>
									<div>
										<a style="color: white;" href="https://www.linkedin.com" target="_blank">linkedin</a>
									</div>
								</li>
							</ul>
						</div>
					</div>



				</div>
			</div>
		</section>
		<!-- /Contact info Section -->




	</div>
	<div class="footer-bottom-are text-center ptb-20" style="background-color:rgb(100, 90, 60);" >
	    <p><span class="text-bold" ><a style="color:white" href="{{ url('/') }}">Fashion</a></span></p>
	<span>copyright © 2022 all rights reserved</span>
    </div>
</footer>








         <!-- jquery js -->
        <script src="{{ asset('public/js/vendor/jquery-1.12.4.min.js') }}" crossorigin="anonymous"></script>
         <!--<script src="{{ asset('public/js/jquery-3.5.1.js') }}" crossorigin="anonymous"></script>-->

        <!-- bootstrap js -->
        <script src="{{ asset('public/js/popper.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('public/js/bootstrap.min.js') }}" crossorigin="anonymous"></script>
        <!-- Toastr -->
        <script src="{{ asset('public/libs/toastr.min.js') }}" crossorigin="anonymous"></script>
        <!-- meanmenu js -->
        <script src="{{ asset('public/js/jquery.meanmenu.min.js') }}" crossorigin="anonymous"></script>
        <!-- owl.carousel js -->
        <script src="{{ asset('public/js/owl.carousel.min.js') }}" crossorigin="anonymous"></script>
        <!-- isotope js -->
        <script src="{{ asset('public/js/isotope.pkgd.min.js') }}" crossorigin="anonymous"></script>
        <!-- magnific-popup js -->
        <script src="{{ asset('public/js/jquery.magnific-popup.min.js') }}" crossorigin="anonymous"></script>
        <!-- counterup js -->
        <script src="{{ asset('public/js/jquery.counterup.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('public/js/waypoints.min.js') }}" crossorigin="anonymous"></script>
        <!-- plugins js -->
        <script src="{{ asset('public/js/plugins.js') }}" crossorigin="anonymous"></script>
        
        <!-- main js -->
        <script src="{{ asset('public/js/main.js') }}" crossorigin="anonymous"></script>

        <script src="{{ asset('public/js/jquery.dataTables.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('public/js/dataTables.bootstrap4.min.js') }}" crossorigin="anonymous"></script>

        <!-- confirm message -->
        <script src="{{ asset('public/js/jquery-confirm.js') }}" crossorigin="anonymous"></script>

        <!-- chosen -->
        <script src="{{ asset('public/libs/chosen.jquery.js') }}" crossorigin="anonymous"></script>

        <!--validation-->
        <script type="text/javascript" src="{{ asset('public/js/parsley.js') }}"></script>
       
        <script type="text/javascript" src="{{ asset('public/slick/slick/slick.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('public/js/xzoom.min.js') }}"></script>
        <script src="{{ asset('public/js/wow.min.js') }}"></script>

       
        <!-- Bkash layout-->


<script id = "myScript" src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{ asset('public/js/jQuery.print.min.js') }}" crossorigin="anonymous"></script>


        @yield('extralibincludefooter')
        




		@yield('getjs')

    </body>
</html>

<script>

new WOW().init();


</script>