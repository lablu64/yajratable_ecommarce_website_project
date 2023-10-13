{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
{{-- </head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Lablu learn') }}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/bootstrap4/bootstrap.min.css">
<link href="{{ asset('public/frontend') }}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/backend/plugins/toastr/toastr.css') }}">
 
{{-- //shop --}}


</head>

<body>

<div class="super_container">
	
	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('public/frontend') }}/images/phone.png" alt=""></div>+8801750092641</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('public/frontend') }}/images/mail.png" alt=""></div><a href="mailto:labluislam435@gmail.com">labluislam435@gmail.com</a></div>
						<div class="top_bar_content ml-auto">
							@if (Auth::check())
							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="#">{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i></a>
											<ul>
												<li><a href="{{route('home') }}">Profile</a></li>
											<li><a href="#">Setting</a></li>
											<li><a href="#">Order List</a></li>
											<li><a href="{{ route('customar.logout') }}">logout</a></li>
											</ul>
									</li>
								</ul>
							</div>		

								
							@endif
							@guest
							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										
										<a href="#">Sign in<i class="fas fa-chevron-down"></i></a>
											<ul  style="width:256px;">
												<form action="{{ route('login') }}" method="POST">
													@csrf
													<div class="form-group"  style="padding: 2px 2px;margin: 8px 5px 7px 8px;">
														<label for="">Email</label>
														<input type="email" name="email" id="email" autocomplete="off" class="form-control" required >
													
													</div>
													<div class="form-group"  style="padding: 2px 2px;margin: 8px 5px 7px 8px;">
														<label for="">Password</label>
														<input type="password" name="password" id="password" class="form-control" required >
														
													</div>
													<div class="offset-md-2">
														<div class="form-check">
															<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
						
															<label class="form-check-label" for="remember">
																{{ __('Remember Me') }}
															</label>
														</div>
													</div>
													<button type="submit" class="btn btn-sm btn-info">sign in</button>
												</form>
											</ul>
									  
									   
										
									</li>
									<li>
										
											
										
										<a href="{{ route('register') }}">Register<i class="fas fa-chevron-down"></i></a>
										
											{{-- <ul  style="width:256px;">
												<form action="" method="POST">
													@csrf
													<div class="form-group"  style="padding: 2px 2px;margin: 8px 5px 7px 8px;">
														<label for="">Name</label>
														<input type="text" name="name" id="name" class="form-control" required >
													
													</div>
													<div class="form-group"  style="padding: 2px 2px;margin: 8px 5px 7px 8px;">
														<label for="">Email</label>
														<input type="email" name="email" id="email" class="form-control" required >
													
													</div>
													<div class="form-group"  style="padding: 2px 2px;margin: 8px 5px 7px 8px;">
														<label for="">Password</label>
														<input type="password" name="password" id="password" class="form-control" required >
														
													</div>
													<div class="form-group"  style="padding: 2px 2px;margin: 8px 5px 7px 8px;">
														<label for="">Comform Password</label>
														<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required >
														
													</div>
													<button type="submit" class="btn btn-sm btn-success">Register </button>
												</form>
											</ul>
											 --}}
									</li>
								</ul>
							</div>
							@endguest
								<div class="top_bar_menu">
									<ul class="standard_dropdown top_bar_dropdown">
										<li>
											<a href="#">English<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">Italian</a></li>
											<li><a href="#">Spanish</a></li>
											<li><a href="#">Japanese</a></li>
										</ul>
										</li>
										<li>
											<a href="#">$ Dollar<i class="fas fa-chevron-down"></i></a>
											<ul>
												<li><a href="#">EUR Euro</a></li>
												<li><a href="#">GBP British Pound</a></li>
												<li><a href="#">JPY Japanese Yen</a></li>
											</ul>
										</li>
									</ul>
								</div>
							
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="#">Lablulearn</a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="#" class="header_search_form clearfix">
										<input type="search" required="required" class="header_search_input" placeholder="Search for products...">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="#">All Categories</a></li>
													<li><a class="clc" href="#">Computers</a></li>
													<li><a class="clc" href="#">Laptops</a></li>
													<li><a class="clc" href="#">Cameras</a></li>
													<li><a class="clc" href="#">Hardware</a></li>
													<li><a class="clc" href="#">Smartphones</a></li>
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ asset('public/frontend') }}/images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- Wishlist -->
					@php
						$wishlist = DB::table('wishlists')->where('user_id',Auth::id())->count();
					@endphp
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="{{ asset('public/frontend') }}/images/heart.png" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="{{ route('wishlist') }}">Wishlist</a></div>
									<div class="wishlist_count">{{ $wishlist }}</div>
								</div>
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<a href="{{ route('cart') }}"><img src="{{ asset('public/frontend') }}/images/cart.png" alt=""></a>
										<div class="cart_count"><span>{{ Cart::count(); }}</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{ route('cart') }}">Cart</a></div>
										<div class="cart_price">{{ $setting->currency }} {{ Cart::total(); }}</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Main Navigation -->

		@yield('navbar')

	 

		
		<!-- Menu -->

		

	</header>
	
	@yield('content')
	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="#">OneTech</a></div>
						</div>
						<div class="footer_title">Got Question? Call Us 24/7</div>
						<div class="footer_phone">+38 068 005 3570</div>
						<div class="footer_contact_text">
							<p>17 Princess Road, London</p>
							<p>Grester London NW18JR, UK</p>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-youtube"></i></a></li>
								<li><a href="#"><i class="fab fa-google"></i></a></li>
								<li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-2 offset-lg-2">
					<div class="footer_column">
						<div class="footer_title">Find it Fast</div>
						<ul class="footer_list">
							<li><a href="#">Computers & Laptops</a></li>
							<li><a href="#">Cameras & Photos</a></li>
							<li><a href="#">Hardware</a></li>
							<li><a href="#">Smartphones & Tablets</a></li>
							<li><a href="#">TV & Audio</a></li>
						</ul>
						<div class="footer_subtitle">Gadgets</div>
						<ul class="footer_list">
							<li><a href="#">Car Electronics</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<ul class="footer_list footer_list_2">
							<li><a href="#">Video Games & Consoles</a></li>
							<li><a href="#">Accessories</a></li>
							<li><a href="#">Cameras & Photos</a></li>
							<li><a href="#">Hardware</a></li>
							<li><a href="#">Computers & Laptops</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title">Customer Care</div>
						<ul class="footer_list">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order Tracking</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Customer Services</a></li>
							<li><a href="#">Returns / Exchange</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="#">Product Support</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_1.png" alt=""></a></li>
								<li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_2.png" alt=""></a></li>
								<li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_3.png" alt=""></a></li>
								<li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_4.png" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('public/frontend') }}/js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('public/frontend') }}/styles/bootstrap4/popper.js"></script>
<script src="{{ asset('public/frontend') }}/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/slick-1.8.0/slick.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/easing/easing.js"></script>
<script src="{{ asset('public/frontend') }}/js/custom.js"></script>
<script src="{{ asset('public/frontend') }}/js/product_custom.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/parallax-js-master/parallax.min.js"></script>
<script src="{{ asset('public/frontend') }}/js/shop_custom.js"></script>

<script type="text/javascript" src="{{ asset('public/backend/plugins/toastr/toastr.min.js') }}"></script>



<script type="text/javascript">
	//ajax request send for collect childcategory
	 $(document).on('click', '.quick_view', function(){ 
		
	   var id = $(this).attr("id");
		$.ajax({
		   url: "{{ url("/product-quick-view/") }}/"+id,
		   type: 'get',
		   success: function(data) {
				$("#quick_view_body").html(data);
		   }
		});
	 });

	 $('#newsletter_customar').submit(function(e){
				e.preventDefault();
				var url = $(this).attr('action');
				var request =$(this).serialize();
				$.ajax({
				url:url,
				type:'post',
				async:false,
				data:request,
				success:function(data){  
					toastr.success(data);
					$('#newsletter_customar')[0].reset();
				}
				});
			});

</script>
<script type="text/javascript" charset="utf-8">
    function cart() {
         $.ajax({
            type:'get',
            url:'{{ route('all.cart') }}', 
            dataType: 'json',
            success:function(data){
               $('.cart_qty').empty();
               $('.cart_total').empty();
               $('.cart_qty').append(data.cart_qty);
               $('.cart_total').append(data.cart_total);
            }
        });
    }
    $(document).ready(function(event) {
        cart();
    });
    
 </script>

 
<script>
	@if(Session::has('messege'))
	  var type="{{Session::get('alert-type','info')}}"
	  switch(type){
		  case 'info':
			   toastr.info("{{ Session::get('messege') }}");
			   break;
		  case 'success':
			  toastr.success("{{ Session::get('messege') }}");
			  break;
		  case 'warning':
			 toastr.warning("{{ Session::get('messege') }}");
			  break;
		  case 'error':
			  toastr.error("{{ Session::get('messege') }}");
			  break;
			}
	@endif
  </script>

  	



</body>

</html>
