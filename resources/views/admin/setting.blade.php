@extends('layouts.master')

@section('content')

    <!-- Header -->
    <div class="header bg-gradient-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7 text-left">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('master.DASHBOARD')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{__('master.SETTINGS')}}</li>
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
        
    <form class="setting_form">
        @csrf

        <div class="row">

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header"><i class="ni ni-settings"></i> {{__('master.SETTINGS')}} </div>

                        <div class="card-body">

                            <h6 class="heading-small text-muted font-weight-bold text-left"> Project Name  </h6>
                            <div class="px-lg-4">
                                <div class="row">
                                    <div class="input-group col-12 px-0">
                                        <input id="project_name" class="form-control" type="text" name="project_name"  value="{{$setting->project_name}}" required>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-3" />

                            <h6 class="heading-small text-muted font-weight-bold text-left"> Phone</h6>
                            <div class="px-lg-4">
                                <div class="row">
                                    <div class="input-group col-12 px-0">
                                        <input id="phone" class="form-control" type="text" name="phone"  value="{{$setting->phone}}" required>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-3" />

                            <h6 class="heading-small text-muted font-weight-bold text-left"> Email</h6>
                            <div class="px-lg-4">
                                <div class="row">
                                    <div class="input-group col-12 px-0">
                                        <input id="email" class="form-control" type="email" name="email"  value="{{$setting->email}}" required>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-3" />

                            <h6 class="heading-small text-muted font-weight-bold text-left"> Address</h6>
                            <div class="px-lg-4">
                                <div class="row">
                                    <div class="input-group col-12 px-0">
                                        <input id="address" class="form-control" type="text" name="address"  value="{{$setting->address}}" required>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-3" />

                            <h6 class="heading-small text-muted font-weight-bold text-left"> 1 Dollar = </h6>
                            <div class="px-lg-4">
                                <div class="row">
                                    <div class="input-group col-12 px-0">
                                        <input id="dollar" class="form-control" type="number" step="0.01" name="dollar"  value="{{$setting->dollar}}" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-4">

                    <div class="card card-defualt">
                    <div class="card-header"><i class="far fa-id-badge"></i> {{__('master.LOGO')}} </div>
                        <div class="card-body px-3">
                            <div class="image-preview" style="background-image: url({{ asset('storage/'.$setting->logo) }})"></div>
                            
                            <input class="d-none" type="file" accept="image/*" id="logo" name="logo" multiple="false" />
                            <label for="logo" class="btn btn-info btn-block btn-sm my-3"><i class="fa fa-image"></i> {{__('master.CHANGE')}}</label>
                        </div>
                    </div>

                </div>

                <div class="col-xl-12">
                    <div class="card card-defualt">
                        <div class="card-body">
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-success btn-block submit">{{__('master.SAVE-CHANGES')}}</button>
                            </div>
                        </div>
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

    function readURL(input) 
    {
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();
            
            reader.onload = function (e) 
            {
                $('.image-preview').css('background-image','url('+e.target.result+')');
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#logo").change(function()
    {
        readURL(this);
    });

    // =============  Setting Form =============
    $(document).on('submit', '.setting_form', function(e)
    {
        e.preventDefault();
        let formData = new FormData(this);
        $('.submit').prop('disabled', true);
        
        var head1 	= "{{__('master.DONE')}}";
        var title1 	= "{{__('master.DATA-CHANGED-SUCCESSFULLY')}}";
        var head2 	= "{{__('master.OOPS')}}";
        var title2 	= "{{__('master.SOMETHING-WRONG')}}";

        $.ajax({
            url: 		"{{route('edit-setting')}}",
            method: 	'POST',
            data: formData,
            dataType: 	'json',
            contentType: false,
            processData: false,
            success : function(data)
                {
                    $('.submit').prop('disabled', false);
                    
                    if (data['status'] == 'true')
                    {
                        Swal.fire(
                                head1,
                                title1,
                                'success'
                                )
                    }
                    else if (data['status'] == 'false')
                    {
                        Swal.fire(
                                head2,
                                title2,
                                'error'
                                )
                    }
                },
                error : function(reject)
                {
                    $('.submit').prop('disabled', false);

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val)
                    {
                        Swal.fire(
                                head2,
                                val[0],
                                'error'
                                )
                    });
                }
            
            
        });

    });

</script>

<script>



</script>

@endsection
