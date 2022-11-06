@extends('layouts.master')

@section('style')
@endsection

@section('content')


    <!-- Header -->
    <div class="header bg-gradient-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">

            <div class="col-lg-6 col-12 text-left">
              <nav aria-label="breadcrumb" class="d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('master.DASHBOARD')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('staff.index')}}">Staff</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Staff Details</li>
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

    <div class="row">

        <div class="col-xl-4">

            <div class="card card-defualt">
                <div class="card-body px-3">
                    <div class="avatar-preview" style="background-image: url({{ asset($item->avatar)}})"></div>

                    <div class="text-center">
                        <h3 class="mt-2">
                            <b>{{$item->name}}</b>
                        </h3>


                        
                        @if ($item->disable == 0)
                            <div class="btn btn-sm btn-success">{{__('master.ACTIVE')}}</div>
                        @else
                            <div class="btn btn-sm btn-danger">{{__('master.BANNED')}}</div>
                        @endif
                            
                    </div>
                    
                </div>
            </div>





        </div>

        <div class="col-xl-8">

            <div class="card card-defualt">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{__('master.PERSONAL-INFORMATION')}} </div>
                <div class="card-body">
                        
                        <div class="row">

                            <!--=================  Name  =================-->
                            <div class="form-group col-md-6 mb-2 text-left">
                                <label class="font-weight-bold text-uppercase">{{__('master.NAME')}}</label>
                                <input type="text" class="form-control" value="{{ $item->name }}" disabled>
                            </div>

                            <!--=================  Phone  =================-->
                            <div class="form-group col-md-6 mb-2 text-left">
                                <label class="font-weight-bold text-uppercase">{{__('master.PHONE')}} </label>
                                <input type="text" class="form-control" value="{{ $item->phone }}" disabled>
                            </div>

                        </div>
                        <hr class="my-2">

                        <div class="row">

                            <!--=================  E-mail  =================-->
                            <div class="form-group col-md-6 mb-2 text-left">
                                <label class="font-weight-bold text-uppercase">{{__('master.EMAIL')}}</label>
                                <input type="text" class="form-control" value="{{ $item->email }}" disabled>
                            </div>

                            <!--=================  Gender  =================-->
                            <div class="form-group col-md-6 mb-2 text-left">
                                <label class="font-weight-bold text-uppercase">{{__('master.GENDER')}}</label>

                                <select class="form-control" disabled>
                                    <option value="Male" @if ($item->gender == 'Male') selected @endif>{{__('master.MALE')}}</option>
                                    <option value="Female" @if ($item->gender == 'Female') selected @endif>{{__('master.FEMALE')}}</option>
                                </select>
                            </div>

                        </div>
                        <hr class="my-2">

                        <div class="row">

                            <!--=================   Birthdate  =================-->
                            <div class="form-group col-md-6 mb-2 text-left">
                                <label class="font-weight-bold text-uppercase">{{__('master.BIRTHDATE')}}</label>
                                <input type="date" class="form-control" value="{{ $item->birthdate }}" disabled>
                            </div>

                            <!--=================  Nationality  =================-->
                            <div class="form-group col-md-6 mb-2 text-left">
                                <label class="font-weight-bold text-uppercase">{{__('master.NATIONALITY')}}</label>
                                <input type="text" class="form-control" value="{{__('nationality.'.$item->nationality)}}" disabled>
                            </div>

                        </div>

                        <!--=================  Role  =================-->
                        <div class="form-group col-md-6 mb-2 text-left">
                            <label class="font-weight-bold text-uppercase">{{__('master.ROLE')}}</label>
                            <input type="text" class="form-control" value="{{ $item->role }}" disabled>                    
                        </div>                                 

                </div>
            </div>



        </div>

        </div>


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
