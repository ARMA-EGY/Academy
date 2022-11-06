@extends('layouts.front')

@section('style')
	<link rel="stylesheet" href="{{asset('front_assets/css/about.css')}}">
@endsection

@section('content')
    
	<!-- Start of Achievements section
		============================================= -->
	<section class="about__achievements">
		<div class="container about__achievements-container">
			<div class="about___achievements-left">
				<img src="{{asset('front_assets/images/logo.png')}}">
			</div>

			<div class="about__achievements-right">
				<h1>Acheivements</h1>
				<p>
					Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas amet suscipit blanditiis id omnis distinctio, asperiores delectus consequuntur rerum fugit rem unde enim labore hic veniam quia officiis animi nam.
				</p>
				<div class="achievements__cards">
					@foreach ($achievements as $achievement)
						<article class="achievement__card">
							<span class="achievement__icon">
								<img src="{{asset($achievement->image)}}" style="border-radius: 10px;">
							</span>
							<h3>{{$achievement->number}}+</h3>
							<p>{{$achievement->name}}</p>
						</article>  
					@endforeach 
				</div>
			</div>
		</div>
	</section>
	<!-- End of Achievements section
		============================================= -->

	<!-- Start of Team section
		============================================= -->
	<section class="team">
		<h2>Meet Our Team</h2>
		<div class="container team__container">

			@foreach ($teams as $team)
				<article class="team__member">
					<div class="team__member-image">
						<img src="{{asset($team->image)}}">
					</div>
					<div class="team__member-info">
						<h4>{{$team->name}}</h4>
						<p>{{$team->title}}</p>
					</div>
					<div class="team__member-socials">
						<a href="{{$team->facebook}}" target="_blank"><i class="uil uil-facebook-f"></i></a>
						<a href="{{$team->instagram}}" target="_blank"><i class="uil uil-instagram"></i></a>
						<a href="{{$team->twitter}}" target="_blank"><i class="uil uil-twitter-alt"></i></a>
						<a href="{{$team->linkedin}}" target="_blank"><i class="uil uil-linkedin-alt"></i></a>
					</div>
				</article> 
			@endforeach 
		</div>
	</section>
	<!-- End of Team section
		============================================= -->

@endsection


@section('script')


@endsection