
@extends('layouts.front')


@section('content')

	<!-- Start of Courses section
		============================================= -->
        <section class="courses">
            <h2>{{$item->name}}</h2>
            <div class="container header__container">
                <div class="header__left">
                    {!! $item->description !!}
                    <h4 class="mb-1">Price: {{$item->price}}</h4>
                    <div id="paypal-button-container"></div>
                    <a href="#" class="btn btn-primary mb-2"> Subscribe Now</a>
                </div>

                <div class="header__right" style="text-align: center">
                    <div class="header__right-image">
                        <img class="mb-2" src="{{asset($item->image)}}">
                    </div>
                </div>  
            </div>

            <div class="container text-center" style="display: flex; max-width:400px; height:400px;">
                @if ($item->type == 'Video')
                    <video style="margin: auto; width:100%" controls>
                        <source src="{{asset($item->file)}}" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>
                @else
                    <iframe width="560" height="315" style="width:100%" src="https://www.youtube.com/embed/{{$endofurl}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @endif
            </div>

        </section>  
    <!-- End of Courses section
        ============================================= -->


@endsection


@section('script')
    <script src="https://www.paypal.com/sdk/js?client-id=ASy8ML1r4orfFEKy5NO0XLQrvstuPwdP415LRbaR4vpM-_YdmFBVdK2ClKaaYx30ixwtD92oSUinR_BH" ></script>
    <script>
        paypal.Buttons({
                createOrder: function(data, actions) {
                    // This function sets up the details of the transaction, including the amount and line item details.
                    return actions.order.create(
                    {
                        application_context: { 'shipping_preference': 'NO_SHIPPING' },
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