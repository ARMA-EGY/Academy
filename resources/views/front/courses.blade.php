@extends('layouts.front')

@section('style')
<style>
    .courses 
    {
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')

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

@endsection

@section('script')


@endsection