<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('front_assets/images/favicon.png')}}">

	<!-- Page Title -->
    <title>{{$setting->project_name}}</title>

    <!-- * INFO: ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
   
    <!--* INFO: Google FONTS (MONTSERRAT) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

	<!-- Style -->
	<link rel="stylesheet" href="{{asset('front_assets/css/style.css')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

	@yield('style')

</head>
<body>

	<!-- Start of Header Navbar
		============================================= -->
		<nav>    
			<div class="container nav__container">
				<a href="{{route('welcome')}}"><h4>Abou Khadra Academy</h4></a>
				<ul class="nav__menu">
					<li><a href="{{route('welcome')}}">Home</a></li>
					<li><a href="{{route('about')}}">About</a></li>
					<li><a href="{{route('courses')}}">Courses</a></li>
					<li><a href="{{route('contact')}}">Contact</a></li>
					@if(Auth::check())
						<li><a href="#">{{Auth::user()->name}}</a></li>
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
							<i class="ni ni-user-run"></i>
							<span>{{__('master.LOGOUT')}}</span>
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					@else 
						<li><a href="{{route('signin')}}">SignIn/SignUp</a></li>
					@endif
				</ul>
				<button id="open-menu-btn"><i class="uil uil-bars"></i></button>
				<button id="close-menu-btn"><i class="uil uil-multiply"></i></button>
			</div>
		</nav>
 	<!-- Start of Header Navbar 
 		============================================= -->

    
        @yield('content')


	<!-- Start of footer section
		============================================= -->
		<footer>
            <div class="container footer__container">
				<div class="footer_1">
					<a href="{{route('welcome')}}" class="footer__logo"><h4>Abou Khadra Academy</h4></a>
					<p>
						Lorem ipsum dolor sit amet consectetur adipisicing elit.Corporis ipsum nobis ratione.
					</p>
				</div>
	
				 <div class="footer__2">
					<h4>Permalinks</h4>
					<ul class="permalinks">
					  <li><a href="{{route('welcome')}}"> Home </a></li>
					  <li><a href="{{route('about')}}"> About </a></li>
					  <li><a href="{{route('courses')}}"> Courses </a></li>
					  <li><a href="{{route('contact')}}"> Contact </a></li>
					</ul>
				</div>
	
				<div class="footer__3">
					<h4>Privacy</h4>
					<ul class="privacy">
					  <li><a href="#"> Privacy Policy </a></li>
					  <li><a href="#"> Terms and conditions </a></li>
					  <li><a href="#"> Refund Policy </a></li>
					</ul>
				</div>
				<div class="footer__4">
					<h4>Contact Us</h4>
					<div>                      
					  <p>{{$setting->phone}}</p>
					  <p>{{$setting->email}}</p>
					</div>
	
					<ul class="footer__socials">
						@foreach ($socials as $social)
							@if ($social->platform == 'Facebook' && $social->off == 1)
								<li><a href="{{$social->link}}" target="_blank" title="{{$social->platform}}"><i class="uil uil-facebook-f"></i></a></li>
							@endif

							@if ($social->platform == 'Twitter' && $social->off == 1)
								<li><a href="{{$social->link}}" target="_blank" title="{{$social->platform}}"><i class="uil uil-twitter"></i></a></li>
							@endif

							@if ($social->platform == 'Instagram' && $social->off == 1)
								<li><a href="{{$social->link}}" target="_blank" title="{{$social->platform}}"><i class="uil uil-instagram-alt"></i></a></li>
							@endif

							@if ($social->platform == 'Linkedin' && $social->off == 1)
								<li><a href="{{$social->link}}" target="_blank" title="{{$social->platform}}"><i class="uil uil-linkedin-alt"></i></a></li>
							@endif

							@if ($social->platform == 'Youtube' && $social->off == 1)
							<li><a href="{{$social->link}}" target="_blank" title="{{$social->platform}}"><i class="uil uil-youtube"></i></a></li>
							@endif
						@endforeach
					</ul>
				</div>
			</div>
			<div class="footer__copyright">
				<small>Copyright &copy; {{$setting->project_name}}</small>
			</div>
		</footer>
	<!-- End of footer section
		============================================= -->


		<!-- For Js Library -->
		<script src="{{asset('front_assets/js/jquery-2.1.4.min.js')}}"></script>
		<script src="{{asset('front_assets/js/main.js')}}"></script>
		<script type="application/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

		<script>
			$('.contact_form').submit(function(e)
			{
				e.preventDefault();
				$('.submit').prop('disabled', true);
				$('.error').text('');

					var head1 	= 'Thank You';
					var title1 	= 'Your Message Has Been Sent Successfully, We will contact you ASAP. ';
					var head2 	= 'Oops...';
					var title2 	= 'Something went wrong, please try again later.';

				$.ajax({
					url: 		"{{route('message')}}",
					method: 	'POST',
					dataType: 	'json',
					data:		$(this).serialize()	,
					success : function(data)
						{
							$('.submit').prop('disabled', false);
							
							if (data['status'] == 'true')
							{
								Swal.fire(
										head1,
										title1,
										'success'
										)
								$('.field1').text('');
								$('.field1').val('');
							}
							else if (data['status'] == 'false')
							{
								Swal.fire(
										head2,
										title2,
										'error'
										)
							}
						},
						error : function(reject)
						{
							$('.submit').prop('disabled', false);

							var response = $.parseJSON(reject.responseText);
							$.each(response.errors, function(key, val)
							{
								Swal.fire(
										head2,
										val[0],
										'error'
										)
							});
						}
					
					
				});

			});
		</script>

        @yield('script')
</body>
</html>
