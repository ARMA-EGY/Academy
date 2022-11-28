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
                  <li class="breadcrumb-item"><a href="{{route('courses.index')}}">Courses</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($item) ? __('master.EDIT-COURSE') : __('master.ADD-NEW-COURSE') }}</li>
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

        <form class="upload_form" action="{{ isset($item) ? route('courses.update', $item->id) : route('courses.store')  }}" method="post" enctype="multipart/form-data">
            @csrf

            @if (isset($item))
               @method('PUT')
            @endif

            <div class="row">

                <div class="col-xl-8">

                    <div class="card card-defualt">
                        <div class="card-header"><i class="fa fa-info-circle"></i> {{__('master.COURSE-INFORMATION')}} </div>
                        <div class="card-body">
                                
                            <!--=================  Name  =================-->
                            <div class="row">
                                <div class="form-group col-md-6 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">{{__('master.NAME')}}</label>
                                    <input type="text" name="name" class="@error('name') is-invalid @enderror form-control" placeholder="{{__('master.NAME')}}" value="{{ isset($item) ? $item->name : old('name') }}" required>
                                    @error('name')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">{{__('master.CATEGORY')}}</label>

                                    <select class="form-control" name="category_id" required>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" @if (isset($item))  @if ($item->category_id == $category->id ) selected @endif @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="my-2">

                            <div class="row">
                                <div class="form-group col-md-12 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">Brief</label>
                                    <input type="text" name="brief" class="@error('brief') is-invalid @enderror form-control" value="{{ isset($item) ? $item->brief : old('brief') }}" required>
                                    @error('brief')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="my-2">

                            <div class="row">
                                <div class="form-group col-md-6 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">{{__('master.PRICE')}} </label>
                                    <input type="number" min="0" step="0.01" name="price" class="@error('price') is-invalid @enderror form-control" placeholder="{{__('master.PRICE')}}" value="{{ isset($item) ? $item->price : old('price') }}" required>
                                
                                    @error('price')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">Promo Video Type </label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="Youtube" @if (isset($item))  @if ($item->type == 'Youtube' ) selected @endif @endif>Youtube Link</option>
                                        <option value="Video" @if (isset($item))  @if ($item->type == 'Video' ) selected @endif @endif>Upload Video</option>
                                    </select>

                                    @error('type')
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="my-2">

                            <div class="row box" id="Youtube">
                                <div class="form-group col-md-12 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">Youtube Link</label>
                                    <input type="link" name="link" class="form-control" placeholder="Youtube Link Here..." value="{{ isset($item) ? $item->link : old('link') }}">
                                </div>
                            </div>

                            <div class="row box" id="Video">
                                <div class="form-group col-md-12 mb-2 text-left">
                                    <label class="font-weight-bold text-uppercase">Upload Promo Video</label>
                                    <input class="btn-info form-control form-control-sm" type="file" accept="video/*" multiple name="file" />
                                </div>

                                @isset($item)
                                    @if($item->file != '')
                                        <div class="form-group">
                                            <iframe src="{{asset($item->file)}}" frameborder="0" width="100%" style="width: 100%;min-height: 300px;"></iframe>
                                        </div>
                                    @endif
                                @endisset
                            </div>
                                
                        </div>
                    </div>
                    
                </div>

                <div class="col-xl-4">

                    <div class="card card-defualt">
                        <div class="card-header"><i class="far fa-id-badge"></i> {{__('master.COURSE-PICTURE')}} </div>
                        <div class="card-body px-3">
                            <div class="avatar-preview" style="background-image: url({{ isset($item) ?  asset($item->image)  : asset('images/no-image.png') }})"></div>
                            <div class="my-2 text-left">
                              <small> {!! __('master.IMAGE-INFO') !!} </small> 
                            </div>
                            <input class="btn-info form-control form-control-sm" required type="file" accept="image/*" id="avatar" name="image" multiple="false" />
                        </div>
                    </div>

                </div>

                <!-- Videos -->
                <div class="col-xl-12">
                    <div class="card card-defualt">
                        <div class="card-header"><i class="fa fa-video"></i> Videos </div>
                        <div class="card-body">

                            <div class="form-group">
                                <div class="text-right">
                                    <a class="btn btn-sm btn-primary text-white add_image"><i class="fa fa-plus"></i></a>
                                </div>

                                <div id="append_images">

                                    @if (isset($item->videos))
                                        <div class="row">
                                            @foreach ($item->videos as $video)
                                                <div class="parent col-md-3 text-center m-2">
                                                    <div class="row image-card">

                                                        <div class="form-group col-md-12">
                                                            <iframe src="{{asset($video->path)}}" frameborder="0" width="100%" style="width: 100%;min-height: 300px;"></iframe>
                                                        </div>

                                                        <div class="form-group col-md-6 text-center">
                                                            <label class="text-sm">{{$video->name}}</label>
                                                        </div>

                                                        <div class="form-group col-md-6 m-auto text-center">
                                                            <a class="btn btn-sm btn-danger remove_item text-white"
                                                                data-id="{{ $video->id }}"
                                                                data-url="{{ route('course.remove.video') }}"><i
                                                                    class="fa fa-trash "></i> </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="form-row">
                                            <div class="form-group col-md-5 mb-2 text-left">
                                                <label class="text-sm"
                                                    for="video_name">Video Name</label>
                                                <input id="video_name" type="text" name="video_name[]"
                                                    class="form-control form-control-sm"
                                                    placeholder="Name"
                                                    value="" required>
                                            </div>

                                            <div class="form-group col-md-5 mb-1 text-left">
                                                <label class="text-sm"> Video File</label>
                                                <input type="file" accept="video/*"
                                                    class="form-control form-control-sm" name="video_file[]" required>
                                            </div>
                                        </div>
                                    @endif

                                </div>


                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card card-defualt">
                        <div class="card-header"> Description</div>
                        <div class="card-body">
                                <div class="form-group">
                                    <textarea id="content" class="content" name="description" rows="20">{{ isset($item) ? $item->description : old('description') }}</textarea>
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

    <!--========= Upload Photos Modal =========-->
    <div id="upload_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                
                <div class="modal-body" id="upload_body">
                    
                    <div class="">
    
                        <div class="form-group col-md-12">
                        <label for="" class="font-weight-bold"> Upload course : </label>
                        </div>
                        
                        {{-- <div class="bararea m-2">
                            <div class="bar"></div>
                        </div> --}}
                        <div class="form-group col-md-12 text-center">
                            <div class="spinner-border" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </div>
    
                        <div class="percent"></div>
                        <div class="status"></div> 
    
                    </div>
                    
                </div>
            
        </div>
        </div>
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
            if (input.files && input.files[0]) 
            {
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

                file_picker_callback (callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight

                tinymce.activeEditor.windowManager.openUrl({
                url : '/file-manager/tinymce5',
                title : 'Laravel File manager',
                width : x * 0.8,
                height : y * 0.8,
                onMessage: (api, message) => {
                    callback(message.content, { text: message.text })
                }
                })
                }

        });

        $("#type").change(function()
        {
            var value = '#' + $(this).val();
            $('.box').slideUp();
            $(value).slideDown(500);
        });

        $(document).ready(function() 
        {
            var value = '#' + $('#type').val();
            $('.box').slideUp();
            $(value).slideDown(500);
        });

        $(function() 
        {
            $(document).ready(function()
            {
                // var bar     = $('.bar');
                // var percent = $('.percent');
                var status  = $('.status');

                $('.upload_form').ajaxForm({
                    beforeSend: function() 
                    {
                        // var percentVal = '0%';
                        // bar.width(percentVal)
                        // percent.html(percentVal);
                        $('#upload_modal').modal('show');
                    },
                    // uploadProgress: function(event, position, total, percentComplete) 
                    // {
                    //     var percentVal = percentComplete + '%';
                    //     bar.width(percentVal)
                    //     percent.html(percentVal);
                    // },
                    success : function(response)
                    {
                        $('#upload_modal').modal('hide');
                        window.location.href = "{{route('courses.index')}}";
                    }
                });
            }); 
        });

        $('.add_image').click(function() 
        {
            $("#append_images").append(
                '<div class="form-row parent"><div class="form-group col-md-5 mb-2 text-left"><label class="text-sm">Video Name</label><input type="text" name="video_name[]"class="form-control form-control-sm"placeholder="Name"value="" required></div><div class="form-group col-md-5 mb-1 text-left"><label class="text-sm">Video File</label class="text-sm"><input type="file" accept="video/*" class="form-control form-control-sm" name="video_file[]" required></div><div class="form-group col-md-2 mt-4 pt-2"><a class="btn btn-sm btn-danger remove text-white"><i class="fa fa-trash "></i></a></div></div>'
                );
        });

        $(document).on("click", ".choose_selected", function() {
        $('.selected').val(0);
        $(this).next('.selected').val(1);
        });

        $(document).on("click", ".remove", function() {
        $(this).parents('.parent').remove();
        });

        $(document).on("click", ".remove3", function() {
        var item = '.' + $(this).attr('data-class');
        $(item).remove();
        });

    </script>
@endsection
