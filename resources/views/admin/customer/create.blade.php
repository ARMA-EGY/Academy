@extends('layouts.master')

@section('style')
@endsection

@section('content')


    <!-- Header -->
    <div class="header bg-gradient-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">

            <div class="col-lg-12 text-left">
              <nav aria-label="breadcrumb" class="d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('master.DASHBOARD')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customers</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($item) ? 'Edit Customer' : 'Add New Customer' }}</li>
                </ol>
              </nav>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- End: Header -->


    <!-- Page content -->
    <div class="container-fluid mt--6">

        <form action="{{ isset($item) ? route('customer.update', $item->id) : route('customer.store')  }}" method="post" enctype="multipart/form-data">
            @csrf

            @if (isset($item))
               @method('PUT')
            @endif


            <div class="row justify-content-center">
                <div class="col-xl-9">

                    <div class="card card-defualt">
                        <div class="card-header"><i class="fa fa-info-circle"></i> {{__('master.PERSONAL-INFORMATION')}} </div>
                        <div class="card-body">
                                
                                <div class="row">

                                    <!--=================  Name  =================-->
                                    <div class="form-group col-md-12 mb-2 text-left">
                                        <label class="font-weight-bold text-uppercase">{{__('master.NAME')}}</label>
                                        <input type="text" name="name" class="@error('name') is-invalid @enderror form-control" placeholder="{{__('master.NAME')}}" value="{{ isset($item) ? $item->name : old('name') }}" required>
                                    
                                        @error('name')
                                            <div>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        @enderror
                    
                                    </div>

                                </div>
                                <hr class="my-2">

                                <div class="row">
                
                                    <!--=================  Phone  =================-->
                                    <div class="form-group col-md-6 mb-2 text-left">
                                        <label class="font-weight-bold text-uppercase">{{__('master.PHONE')}} </label>
                                        <input type="number" name="phone" class="@error('phone') is-invalid @enderror form-control" placeholder="{{__('master.PHONE')}}" value="{{ isset($item) ? $item->phone : old('phone') }}" required>
                                    
                                        @error('phone')
                                            <div>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        @enderror
                    
                                    </div>

                                    <!--=================  E-mail  =================-->
                                    <div class="form-group col-md-6 mb-2 text-left">
                                        <label class="font-weight-bold text-uppercase">{{__('master.EMAIL')}}</label>
                                        <input type="email" name="email" class="@error('email') is-invalid @enderror form-control" placeholder="{{__('master.EMAIL')}}" value="{{ isset($item) ? $item->email : old('email') }}" required>
                                    
                                        @error('email')
                                            <div>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        @enderror
                    
                                    </div>

                                </div>
   
                        </div>
                    </div>

                    @isset($item)

                    @else
                        <div class="card card-defualt">
                            <div class="card-header"><i class="fas fa-lock"></i> {{__('master.PASSWORD')}} </div>
                            <div class="card-body">
                                <div class="row">

                                    <!--=================  Password  =================-->
                                    <div class="form-group col-md-6 mb-2 text-left">
                                        <label class="form-control-label" for="input-phone">{{__('master.PASSWORD')}}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
            
                                    <!--================= Confirm Password  =================-->
                                    <div class="form-group col-md-6 mb-2 text-left">
                                        <label for="password-confirm" class="form-control-label">{{__('master.CONFIRM-PASSWORD')}}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
            
                                </div>
                                <div class="my-2 text-info text-left">
                                    <small> {!! __('master.PASSWORD-INFO') !!} </small> 
                                </div>
                            </div>
                        </div>  
                    @endisset

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
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script>
        $(document).ready(function() 
        {
            $('.select2').select2();
        });

        function readURL(input) 
        {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) 
                {
                    $('.avatar-preview').css('background-image','url('+e.target.result+')');
                };
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#avatar").change(function()
        {
            readURL(this);
        });

    </script>
@endsection
