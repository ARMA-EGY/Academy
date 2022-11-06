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
                  <li class="breadcrumb-item"><a href="{{route('team.index')}}">Team</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($item) ? 'Edit Member' : 'Add New Member' }}</li>
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

        <form action="{{ isset($item) ? route('team.update', $item->id) : route('team.store')  }}" method="post" enctype="multipart/form-data">
            @csrf

            @if (isset($item))
               @method('PUT')
            @endif

            <div class="row">

                <div class="col-xl-8">

                    <div class="card card-defualt">
                        <div class="card-header"><i class="fa fa-info-circle"></i> Member Information </div>
                        <div class="card-body">

                            <div class="row">

                                <!--=================  Name  =================-->
                                <div class="form-group col-md-6 mb-2">
                                    <label for="name">Name *</label>
                                    <input id="name" type="text" name="name" class="@error('name') is-invalid @enderror form-control" placeholder="Add Name" value="{{ isset($item) ? $item->name : old('name') }}" required>
                                
                                    @error('name')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <!--=================  Title =================-->
                                <div class="form-group col-md-6 mb-2">
                                    <label for="title">Title *</label>
                                    <input id="title" type="text" name="title" class="@error('title') is-invalid @enderror form-control" placeholder="Add Position" value="{{ isset($item) ? $item->title : old('title') }}" required>
                                
                                    @error('title')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                
                                </div>

                            </div>
                            <hr class="my-2">
                            
                            <div class="row">

                                <!--=================  email  =================-->
                                <div class="form-group col-md-6 mb-2">
                                    <label for="email">Email</label>
                                    <input id="email" type="text" name="email" class="@error('email') is-invalid @enderror form-control" placeholder="Add E-mail" value="{{ isset($item) ? $item->email : old('email') }}" >
                                
                                    @error('email')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                
                                </div>

                                <!--=================  phone =================-->
                                <div class="form-group col-md-6 mb-2">
                                    <label for="phone">Phone</label>
                                    <input id="phone" type="number" name="phone" class="@error('phone') is-invalid @enderror form-control" placeholder="phone" value="{{ isset($item) ? $item->phone : old('phone') }}">
                                
                                    @error('phone')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                
                                </div>

                            </div>
                            <hr class="my-2">

                            <div class="row">

                                <!--=================  facebook =================-->
                                <div class="form-group col-md-6 mb-2">
                                    <label for="facebook">Facebook</label>
                                    <input id="facebook" type="text" name="facebook" class="@error('facebook') is-invalid @enderror form-control" placeholder="facebook" value="{{ isset($item) ? $item->facebook : old('facebook') }}">
                                
                                    @error('facebook')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                
                                </div>

                                <!--=================  twitter =================-->
                                <div class="form-group col-md-6 mb-2">
                                    <label for="twitter">Twitter</label>
                                    <input id="twitter" type="text" name="twitter" class="@error('twitter') is-invalid @enderror form-control" placeholder="twitter" value="{{ isset($item) ? $item->twitter : old('twitter') }}">
                                
                                    @error('twitter')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                
                                </div>

                            </div>   
                            <hr class="my-2">

                            <div class="row">

                                <!--=================  Linkedin =================-->
                                <div class="form-group col-md-6 mb-2">
                                    <label for="linkedin">Linkedin</label>
                                    <input id="linkedin" type="text" name="linkedin" class="@error('linkedin') is-invalid @enderror form-control" placeholder="linkedin" value="{{ isset($item) ? $item->linkedin : old('linkedin') }}">
                                
                                    @error('linkedin')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                
                                </div>

                                <!--=================  Instagram =================-->
                                <div class="form-group col-md-6 mb-2">
                                    <label for="instagram">Instagram</label>
                                    <input id="instagram" type="text" name="instagram" class="@error('instagram') is-invalid @enderror form-control" placeholder="instagram" value="{{ isset($item) ? $item->instagram : old('instagram') }}">
                                
                                    @error('instagram')
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
                        <div class="card-header"><i class="far fa-id-badge"></i> Profile Picture </div>
                        <div class="card-body px-3">
                            <div class="avatar-preview" style="background-image: url({{ isset($item) ?  asset($item->image)  : asset('images/avatar.png') }})"></div>
                            <div class="my-2 text-left">
                              <small> {!! __('master.IMAGE-INFO') !!} </small> 
                            </div>
                            <input class="btn-info form-control form-control-sm" type="file" accept="image/*" id="avatar" name="image" multiple="false"  @if(!isset($item))  required @endif  />
                        </div>
                    </div>

                </div>

                <div class="col-xl-12">
                    <div class="card card-defualt">
                        <div class="card-header"> Description</div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea id="content" class="form-control" name="description" rows="5">{{ isset($item) ? $item->description : old('description') }}</textarea>
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
  <script src="https://cdn.tiny.cloud/1/mq6umcdg6y938v1c32lokocdpgrgp5g2yl794h4y1braa6j6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
  
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

    tinymce.init({
        selector:'textarea.content',
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
      });</script>
@endsection
