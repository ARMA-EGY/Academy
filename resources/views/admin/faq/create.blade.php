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
                  <li class="breadcrumb-item"><a href="{{route('faq.index')}}">FAQs</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($item) ? 'Edit FAQ' : 'Add New FAQ' }}</li>
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

        <form action="{{ isset($item) ? route('faq.update', $item->id) : route('faq.store')  }}" method="post" enctype="multipart/form-data">
            @csrf

            @if (isset($item))
               @method('PUT')
            @endif

            <div class="row justify-content-center">

                <div class="col-xl-10">

                    <div class="card card-defualt">
                        <div class="card-header"><i class="fa fa-info-circle"></i> Information </div>
                        <div class="card-body">

                            <div class="row">

                                <!--=================  Question  =================-->
                                <div class="form-group col-md-12 mb-2">
                                    <label for="question">Question</label>
                                    <input id="question" type="text" name="question" class="@error('question') is-invalid @enderror form-control" value="{{ isset($item) ? $item->question : old('question') }}" required>
                                
                                    @error('question')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-2">

                            <div class="row">

                                <!--=================  Answer =================-->
                                <div class="form-group col-md-12 mb-2">
                                    <label for="answer">Answer</label>
                                    <textarea id="answer" class="form-control" name="answer" rows="5" required>{{ isset($item) ? $item->answer : old('answer') }}</textarea>
                                        @error('answer')
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
