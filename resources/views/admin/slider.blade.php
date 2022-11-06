
@extends('layouts.master')

@section('style')
    
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

@endsection

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
                  <li class="breadcrumb-item active" aria-current="page">Slideshow</li>
                </ol>
              </nav>
            </div>

            <div class="col-lg-6 col-5 text-right">

              <form class="upload_photo_form upload_form" action="{{route('admin-update-slider')}}" method="POST" enctype="multipart/form-data">

                <label for="upload_photo" class="btn btn-sm btn-neutral" ><i class="fa fa-plus"></i> Upload Photos</label>
      
                <input class="hidden-input change_photo" id="upload_photo" type="file" name="photo[]" multiple>
                <input type="hidden" name="lang" value="{{$lang2}}">
              </form>
              
            </div>


          </div>
        </div>
      </div>
    </div>
    <!-- End: Header -->


    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">

          <div class="row" id="slider_photos">

              @foreach ($photos as $photo)
          
                  <div class="col-md-4 edit-section parent">
                    <button class="btn btn-success btn-sm edit2 get_text" style="right:75px;" data-id="{{$photo->id}}">
                      <i class="fas fa-edit text-white"></i>
                    </button>
                      <button class="btn btn-danger btn-sm edit2 remove_item" data-id="{{$photo->id}}" data-url="{{route('remove-slider')}}">
                        <i class="fas fa-trash-alt text-white"></i>
                      </button>
                      <a data-fancybox="gallery" href="{{asset('storage/'.$photo->image)}}">
                        <img  class="img-fluid rounded" src="{{asset('storage/'.$photo->image)}}">
                      </a> 
                  </div>
                  
              @endforeach
            
        </div>

        </div>
      </div>
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
                  
                  <div class="form-row">
  
                      <div class="form-group col-md-12">
                      <label for="" class="font-weight-bold"><i class="fa fa-image"></i> Upload : </label>
                      </div>
  
                      <div class="bararea m-2">
                          <div class="bar"></div>
                      </div>
  
                      <div class="percent"></div>
                      <div class="status"></div> 
  
                  </div>
                  
              </div>
          
      </div>
      </div>
    </div>

    <!-- Popup Modal -->
    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-wrapper">
          <div class="modal-dialog modal-lg" id="modal_body">
            
          </div>
        </div>
    </div>

@endsection



@section('script')
   

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


<script>
  $('#example').DataTable( {
      "pagingType": "numbers"
    } );


    // CHANGE PHOTOS 
    
    $(document).on('change', '.change_photo', function(){
      
      $(this).parent('.upload_form').submit();
      
      });	


    $(function() 
    {
      $(document).ready(function()
      {
        var bar     = $('.bar');
        var percent = $('.percent');
        var status  = $('.status');

          $('.upload_photo_form').ajaxForm({
            beforeSend: function() 
            {
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
                $('#upload_modal').modal('show');
            },
            uploadProgress: function(event, position, total, percentComplete) 
            {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            success : function(response)
            {
                $('#upload_modal').modal('hide');
                $('#slider_photos').html(response);
            }
        });
      }); 
    });

        // =============  Get Slider Text =============
        $('.get_text').click(function()
        {
            var id 	= $(this).attr('data-id');
            var loader 	= $('#loader').attr('data-load');

            $('#popup').modal('show');
            $('#modal_body').html(loader);

            $.ajax({
                url:"{{route('getslidertext')}}",
                type:"POST",
                dataType: 'text',
                data:    {"_token": "{{ csrf_token() }}",
                         id: id},
                success : function(response)
                    {
                    $('#modal_body').html(response);
                    }  
                })

        });

        // =============  Edit SEO Data =============
        $(document).on('submit', '.slider_text_form', function(e)
        {
            e.preventDefault();
            let formData = new FormData(this);
            $('.submit').prop('disabled', true);

            var head1 	= 'Done';
            var title1 	= 'Data Changed Successfully. ';
            var head2 	= 'Oops...';
            var title2 	= 'Something went wrong, please try again later.';

            $.ajax({
                url: 		"{{route('updateslidertext')}}",
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
                            $('.modal').modal('hide');
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
    
@endsection
