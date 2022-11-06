@extends('layouts.front')

@section('style')
	<link rel="stylesheet" href="{{asset('front_assets/css/contact.css')}}">
@endsection


@section('content')

	<!-- Start of Contact section
		============================================= -->
        <section class="contact">
            <div class="container contact__container">
                <aside class="contact__aside">
                    <div class="aside__image">
                        <img src="{{asset('front_assets/images/logo.png')}}">
                    </div>
                    <h2>Contact Us</h2>
                    <p>
                        Asperiores veniam vel doloribus assumenda soluta
                        blanditiis dolores qui voluptates,consequatur vitae.
                    </p>
                    <ul class="contact__details">
                        <li>
                        <i class="uil uil-phone-times"></i>
                        <h5>{{$setting->phone}}</h5>
                        </li>
                        <li>
                        <i class="uil uil-envelope"></i>
                        <h5>{{$setting->email}}</h5>
                        </li>
                        <li>
                        <i class="uil uil-location-point"></i>
                        <h5>{{$setting->address}}</h5>
                        </li>
                    </ul>
                    <ul class="contact__socials">
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
                </aside>
        
                <form class="contact_form contact__form">
                    @csrf
                    <div class="form__name">
                         <input type="text" class="field1" name="name" placeholder="Name" required>
                         <input type="phone" class="field1" name="phone" placeholder="Phone" required>
                    </div>
                    <input type="email" class="field1" name="email" placeholder="Your Email Address"
                    required>
                    <textarea name="message" class="field1" rows="7" placeholder="Message"required></textarea>
                    <button type="submit" class="btn btn-primary submit">Send Message</button>
                </form>
            </div>
        </section>
    <!-- End of Contact section
        ============================================= -->

@endsection


@section('script')


@endsection