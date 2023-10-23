@extends('layouts.front')

@section('style')
<link rel="stylesheet" href="{{asset('front_assets/css/about.css')}}">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap');
*{
    margin: 0;
    padding: 0;
}

.card{
    background-color: hsl(0, 0%, 100%);
    padding: 18px;
    border-radius: 17px;
    text-align: center;
    margin: 0 1em;
}
.card img{
    width: 100%;
    border-radius: 12px;
}
.text{
    padding: 22px 10px;
}
.text h2{
    color: hsl(218, 44%, 22%);
    padding-bottom: 15px;
    margin: 0
}
.text p{
    color: hsl(220, 15%, 55%);
}
</style>
@endsection

@section('content')

	<!-- Start of Achievements section
		============================================= -->
	<section class="about__achievements">
		<div class="">


			<div class="about__achievements-right">
                <div class="container">
                    <div class="container courses__container">
                        @foreach ($qr_codes as $qr_code)


                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="card">
                                    <img class="img-fluid" height="200" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{asset($qr_code->image)}}&choe=UTF-8" title="Link to {{asset($qr_code->image)}}" alt="">


                                    <div class="text">
                                        <h2>{{$qr_code->title}}</h2>
                                        <p>{{$qr_code->description}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
			</div>
		</div>
	</section>

@endsection


@section('script')


@endsection
