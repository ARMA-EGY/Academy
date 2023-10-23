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
                  <li class="breadcrumb-item"><a href="{{route('qrcode.index')}}">qrcode</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($item) ? 'ecit qrcode' :  'ADD NEW qrcode' }}</li>
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
        <form class="upload_form" action="{{ isset($item) ? route('qrcode.update', $item->id) : route('qrcode.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            @if (isset($item))
               @method('PUT')
            @endif

            <div class="row">

                <div class="col-xl-8">

                    <div class="card card-defualt">
                        <div class="card-header"><i class="fa fa-info-circle"></i> Qr code information </div>
                        <div class="card-body">

                            <!--=================  Name  =================-->
                            <div class="row">
                                <div class="form-group col-md-6 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">{{__('master.TITLE')}}</label>
                                    <input type="text" name="title" class="@error('title') is-invalid @enderror form-control" placeholder="{{__('master.TITLE')}}" value="{{ isset($item) ? $item->title : old('title') }}" required>
                                    @error('title')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="my-2">

                            <div class="row">
                                <div class="form-group col-md-12 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">description</label>
                                    <textarea name="description" class="@error('description') is-invalid @enderror form-control" required>{{ isset($item) ? $item->description : old('description') }}</textarea>
                                    @error('description')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-4">

                    <div class="card card-defualt">
                        <div class="card-header"><i class="far fa-id-badge"></i> QrCode </div>
                        <div class="card-body px-3">
                            <div class="avatar-preview" style="background-image: url({{ isset($item) ?  asset($item->image)  : asset('images/no-image.png') }})"></div>
                            <div class="my-2 text-left">
                              <small> {!! __('master.IMAGE-INFO') !!} </small>
                            </div>
                            <input class="btn-info form-control form-control-sm" {{ isset($item) ? '' :'required' }}  type="file" name="recorde" />
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
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/mq6umcdg6y938v1c32lokocdpgrgp5g2yl794h4y1braa6j6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


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
