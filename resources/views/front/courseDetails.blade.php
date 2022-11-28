@extends('layouts.front')


@section('style')
    <link rel="stylesheet" href="{{ asset('front_assets/css/courses.css') }}">
@endsection
@section('content')
    <!-- Start of Courses section
          ============================================= -->
    <section class="courses">
        <h2>{{ $item->name }}</h2>
        <div class="container header__container">
            <div class="header__left">
                {!! $item->description !!}
                <h4 class="mb-1">Price: {{ $item->price }} SAR</h4>
            </div>

            <div class="header__right" style="text-align: center">
                <div class="header__right-image">
                    <img class="mb-2" src="{{ asset($item->image) }}">
                </div>
            </div>
        </div>
        {{-- promo vedio --}}
        <div class="container text-center" style="display: flex; max-width:400px; height:350px;position: relative;">
            @if ($subscribed == 0)
                <div class="layout">
                    @if (auth()->user())
                        <a href="#" class="btn btn-primary mb-2"> Subscribe Now</a>
                    @else
                        <a href="{{ route('signin') }}" class="btn btn-primary mb-2"> Subscribe Now</a>
                    @endif
                </div>
            @endif
            @if ($item->type == 'Video')
                <video style="margin: 0 auto; width:100%" controls controlsList="nodownload">
                    <source src="{{ asset($item->file) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @else
                <iframe width="560" height="315" style="width:100%"
                    src="https://www.youtube.com/embed/{{$endofurl}}" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            @endif
        </div>
        {{-- all vedio --}}

        @if ($subscribed == 1)
        <div class="container text-center" style="display: flex;position: relative;">
            <div class="allvedios">
                @if (isset($item->videos))
                    @foreach ($item->videos as $video)
                        <div class="one-vedios">
                            <video style="margin: auto; width:100%" controls controlsList="nodownload">
                                <source src="{{asset($video->path)}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

    </section>
    <svg display="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        width="768" height="800" viewBox="0 0 768 800">
        <defs>
            <g id="icon-close">
                <path class="path1"
                    d="M31.708 25.708c-0-0-0-0-0-0l-9.708-9.708 9.708-9.708c0-0 0-0 0-0 0.105-0.105 0.18-0.227 0.229-0.357 0.133-0.356 0.057-0.771-0.229-1.057l-4.586-4.586c-0.286-0.286-0.702-0.361-1.057-0.229-0.13 0.048-0.252 0.124-0.357 0.228 0 0-0 0-0 0l-9.708 9.708-9.708-9.708c-0-0-0-0-0-0-0.105-0.104-0.227-0.18-0.357-0.228-0.356-0.133-0.771-0.057-1.057 0.229l-4.586 4.586c-0.286 0.286-0.361 0.702-0.229 1.057 0.049 0.13 0.124 0.252 0.229 0.357 0 0 0 0 0 0l9.708 9.708-9.708 9.708c-0 0-0 0-0 0-0.104 0.105-0.18 0.227-0.229 0.357-0.133 0.355-0.057 0.771 0.229 1.057l4.586 4.586c0.286 0.286 0.702 0.361 1.057 0.229 0.13-0.049 0.252-0.124 0.357-0.229 0-0 0-0 0-0l9.708-9.708 9.708 9.708c0 0 0 0 0 0 0.105 0.105 0.227 0.18 0.357 0.229 0.356 0.133 0.771 0.057 1.057-0.229l4.586-4.586c0.286-0.286 0.362-0.702 0.229-1.057-0.049-0.13-0.124-0.252-0.229-0.357z">
                </path>
            </g>
        </defs>
    </svg>

    <div class="modal">
        <div class="modal-overlay modal-toggle"></div>
        <div class="modal-wrapper modal-transition">
            <div class="modal-header">
                <button class="modal-close modal-toggle"><svg class="icon-close icon" viewBox="0 0 32 32">
                        <use xlink:href="#icon-close"></use>
                    </svg></button>
                <h2 class="modal-heading">Subscribe Now</h2>
            </div>

            <div class="modal-body">
                <div class="modal-content">

                    <h4 class="mb-1 price">Price: {{ $item->price }} SAR</h4>
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Courses section
                ============================================= -->
@endsection


@section('script')
    <script
        src="https://www.paypal.com/sdk/js?client-id=ASy8ML1r4orfFEKy5NO0XLQrvstuPwdP415LRbaR4vpM-_YdmFBVdK2ClKaaYx30ixwtD92oSUinR_BH">
    </script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    application_context: {
                        'shipping_preference': 'NO_SHIPPING'
                    },
                    purchase_units: [{
                        amount: {
                            value: '{{$item->price}}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    // alert('Transaction completed by ' + 'mohamed');
                    console.log('success');
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
