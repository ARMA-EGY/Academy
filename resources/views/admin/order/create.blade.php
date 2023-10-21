@extends('layouts.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.css">
@endsection

@section('content')

    <!-- Header -->
    <div class="header bg-gradient-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{route('order.index')}}">Subscriptions</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($item) ? 'Edit FAQ' : 'Add New Subscription' }}</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End: Header -->


    <!-- Page content -->
    <div class="container-fluid mt--6">

        <form action="{{ isset($item) ? route('order.update', $item->id) : route('order.store')  }}" method="post" enctype="multipart/form-data">
            @csrf

            @if (isset($item))
               @method('PUT')
            @endif

            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="card card-defualt">
                        <div class="card-header"><i class="fa fa-info-circle"></i> Information </div>
                        <div class="card-body">

                            <div class="row">

                                <!--=================  Courses  =================-->
                                <div class="form-group col-md-5 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">Course</label>
                                    <select id="course" class="@error('course_id') is-invalid @enderror form-control selectpicker" name="course_id" data-live-search="true" required>
                                        <option value="">Select</option>
                                        @foreach ($courses as $course)
                                            <option value="{{$course->id}}" @if (isset($item))  @if ($item->course_id == $course->id ) selected @endif @endif data-price="{{$course->price}}">{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                
                                    @error('course_id')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <!--=================  Customer  =================-->
                                <div class="form-group col-md-4 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">Customer</label>
                                    <select class="@error('customer_id') is-invalid @enderror form-control selectpicker" name="customer_id" data-live-search="true" required>
                                        <option value="">Select</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}" @if (isset($item))  @if ($item->customer_id == $customer->id ) selected @endif @endif>{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                
                                    @error('customer_id')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                
                                <!--=================  Price  =================-->
                                <div class="form-group col-md-3 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">Price </label>
                                    <input type="number" id="price" name="price" class="@error('price') is-invalid @enderror form-control" placeholder="0.00" value="{{ isset($item) ? $item->price : old('price') }}" required>
                                
                                    @error('price')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                
                                </div>

                            </div> 
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-defualt">
                <div class="card-body">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-success btn-block">{{ isset($item) ?  __('master.SAVE'):__('master.ADD') }}</button>
                    </div>
                </div>
            </div>

        </form>
        
      <!-- Footer -->
      <footer class="footer pt-0">
      </footer>
    </div>

@endsection


@section('script')
  <script>
    $(document).on("change","#course", function()
        {
            var price = $('#course').find(":selected").attr('data-price');
            $('#price').val(price);
        });
  </script>
@endsection
