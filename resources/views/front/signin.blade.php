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
	<link rel="stylesheet" href="{{asset('front_assets/css/signin.css')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

	@yield('style')

</head>
<body>

	<!-- Start of Signin section
		============================================= -->
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form method="POST" action="{{route('register')}}">
                    @csrf
                    <h1 class="mb-2">Create Account</h1>
                    {{-- <div class="social-container">
                        <a href="#" class="social"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="social"><i class="fa fa-google"></i></a>
                        <a href="#" class="social"><i class="fa fa-linkedin"></i></a>
                    </div>
                    <span>or use your email for registration</span> --}}
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" pattern="[0-9]{11}" name="phone" placeholder="Phone" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    <button>SignUp</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form method="POST" action="{{route('login')}}">
                    @csrf
                    <h1 class="mb-2">Sign In</h1>
                    {{-- <div class="social-container">
                        <a href="#" class="social"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="social"><i class="fa fa-google"></i></a>
                        <a href="#" class="social"><i class="fa fa-linkedin"></i></a>
                    </div>
                    <span>or use your account</span> --}}
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                
                    <button type="submit">Sign In</button>

                    @if(session()->has('fail'))	
                        <div class="alert alert-danger alert-dismissible fade show m-2 mt-4" role="alert">
                            {{ session()->get('fail') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif
    
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show p-0 my-4" role="alert" style="font-size: 13px;color: #f00;margin-top: 10px;">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- End of Signin section
        ============================================= -->

<script type="text/javascript">
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container    = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });
    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>

</body>
</html>