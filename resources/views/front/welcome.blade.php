
@extends('layouts.front')


@section('content')

	<!-- Start of Header section
		============================================= -->
		<header>
			<div class="container header__container">
				<div class="header__left">
					<h1> Smile for life, Life smiles for you.
						"تفائلو بالخير تجدوه"</h1>
					<p> 
						Find the right instructor for you. Choose from many topics, skill levels, and languages. Shop thousands of high-quality on-demand online courses. Start learning today.					</p>
					<a href="{{route('courses')}}" class="btn btn-primary"> GetStarted</a>
				</div>
	
				 <div class="header__right">
					<div class="header__right-image">
						<img src="{{asset('front_assets/images/logo.png')}}">
					</div>
				</div>  
			</div>
		</header>
	<!-- End of Header section
		============================================= -->

	<!-- Start of Category section
		============================================= -->
		<section class="categories">
			<div class="container categories__container">
				<div class="categories__left">
					<h1>Categories</h1>
					<p>
						Since there are so many different courses to choose from in our General Education categories, we have assigned a letter to each of them so that you can tell which requirement a course meets by looking at the letter at the end of the course number.
					</p>
					<a href="{{route('courses')}}" class="btn"> Learn More </a>
				</div>  
	
				<div class="categories__right">
					@foreach ($categories as $category)
						<article class="category">
							<span class="">
								<img src="{{asset($category->image)}}" loading="lazy" style="border-radius: 10px;" width="200" height="150">
							</span>
							<h5>{{$category->name}}</h5>
							<p>{{$category->description}}</p>     
						</article>  
					@endforeach
				</div>
			</div>                             
		</section>
	<!-- End of Category section
		============================================= -->

	<!-- Start of Courses section
		============================================= -->
		<section class="courses">
			<h2>Our Popular Courses</h2>
			<div class="container courses__container">
				@foreach ($courses as $course)
					<article class="course">
						<div class="course__image">
							<img src="{{asset($course->image)}}" height="250">
						</div>          
						<div class="course__info">
							<h4>{{$course->name}}</h4>
							<p> 
								{{$course->brief}}
							</p>
							<a href="{{route('course.details', $course->id)}}" class="btn"> Learn More </a>
						</div>
					</article>
				@endforeach
			</div>
		</section>    
	<!-- End of Courses section
		============================================= -->

	<!-- Start of FAQs section
		============================================= -->
		<section class="faqs">
			<h2>Frequently Asked Questions</h2>
			<div class="container faqs__container">
				@foreach ($faqs as $faq)
					<article class="faq">
					<div class="faq__icon"><i class="uil uil-plus"></i></div>
					<div class="question__answer">
						<h4>{{$faq->question}}</h4>
						<p>{{$faq->answer}}</p>           
					</div>
				</article> 
				@endforeach
			</div>
		</section>  
	<!-- End of FAQs section
		============================================= -->

@endsection


@section('script')


@endsection