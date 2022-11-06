
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
                  <li class="breadcrumb-item active" aria-current="page">{{__('master.SOCIAL-MEDIA')}}  </li>
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
        
        
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">{{__('master.SOCIAL-MEDIA')}}</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form class="social_form">
                @csrf
                <h6 class="heading-small text-muted mb-4 text-left">{{__('master.SOCIAL-MEDIA-LINKS')}}</h6>
                <div class="pr-lg-4">
                  <div class="row">


                @if ($socials->count() > 0)

                  @foreach ($socials as $social)

                    @if ($social->platform == 'Facebook')
                        
                      <!-- Facebook -->
                      <div class="input-group col-9 mb-3 px-0">
                        <div class="input-group-prepend">
                          <label for="facebook" class="input-group-text" id="basic-addon1"><i class="fab fa-facebook"></i></label>
                          <input type="hidden" name="platform[]" value="Facebook">
                        </div>
                      <input dir="ltr" id="facebook" class="form-control" type="text" name="link[]" placeholder="Facebook Link" autocomplete="off" aria-describedby="basic-addon1" value="{{$social->link}}">
                      </div>
                      
                      <div class="col-3">
                        <input type="checkbox" class="check_off" name="off2[]" value="1" data-toggle="toggle" data-size="sm" @if ($social->off == '1') checked @endif>
                        <input type="hidden" class="off" name="off[]" @if ($social->off == '1') value="1" @else value="0" @endif>
                      </div>
                      
                      @endif


                    @if ($social->platform == 'Twitter')

                      <!-- Twitter -->
                      <div class="input-group col-9 mb-3 px-0">
                        <div class="input-group-prepend">
                          <label for="twitter" class="input-group-text" id="basic-addon2"><i class="fab fa-twitter"></i></label>
                          <input type="hidden" name="platform[]" value="Twitter">
                        </div>
                        <input dir="ltr" id="twitter" class="form-control" type="text" name="link[]" placeholder="Twitter Link" autocomplete="off" aria-describedby="basic-addon2" value="{{$social->link}}">
                      </div>
                      
                      <div class="col-3">
                        <input type="checkbox" class="check_off" name="off2[]" value="1" data-toggle="toggle" data-size="sm" @if ($social->off == '1') checked @endif>
                        <input type="hidden" class="off" name="off[]" @if ($social->off == '1') value="1" @else value="0" @endif>
                      </div>
                      
                      @endif


                      @if ($social->platform == 'Instagram')

                      <!-- Instagram -->
                      <div class="input-group col-9 mb-3 px-0">
                        <div class="input-group-prepend">
                          <label for="insta" class="input-group-text" id="basic-addon3"><i class="fab fa-instagram"></i></label>
                          <input type="hidden" name="platform[]" value="Instagram">
                        </div>
                        <input dir="ltr" id="insta" class="form-control" type="text" name="link[]" placeholder="Instagram Link" autocomplete="off" aria-describedby="basic-addon3" value="{{$social->link}}">
                      </div>
                      
                      <div class="col-3">
                        <input type="checkbox" class="check_off" name="off2[]" value="1" data-toggle="toggle" data-size="sm" @if ($social->off == '1') checked @endif>
                        <input type="hidden" class="off" name="off[]" @if ($social->off == '1') value="1" @else value="0" @endif>
                      </div>
                      
                      @endif


                      @if ($social->platform == 'Linkedin')

                      <!-- Linkedin -->
                      <div class="input-group col-9 mb-3 px-0">
                        <div class="input-group-prepend">
                          <label for="linkedin" class="input-group-text" id="basic-addon3"><i class="fab fa-linkedin"></i></label>
                          <input type="hidden" name="platform[]" value="Linkedin">
                        </div>
                        <input dir="ltr" id="linkedin" class="form-control" type="text" name="link[]" placeholder="Linkedin Link" autocomplete="off" aria-describedby="basic-addon3" value="{{$social->link}}">
                      </div>
                      
                      <div class="col-3">
                        <input type="checkbox" class="check_off" name="off2[]" value="1" data-toggle="toggle" data-size="sm" @if ($social->off == '1') checked @endif>
                        <input type="hidden" class="off" name="off[]" @if ($social->off == '1') value="1" @else value="0" @endif>
                      </div>

                    @endif


                    @if ($social->platform == 'Pinterest')

                    <!-- Pinterest -->
                    <div class="input-group col-9 mb-3 px-0">
                      <div class="input-group-prepend">
                        <label for="linkedin" class="input-group-text" id="basic-addon3"><i class="fab fa-pinterest"></i></label>
                        <input type="hidden" name="platform[]" value="Pinterest">
                      </div>
                      <input dir="ltr" id="pinterest" class="form-control" type="text" name="link[]" placeholder="Pinterest Link" autocomplete="off" aria-describedby="basic-addon3" value="{{$social->link}}">
                    </div>
                    
                    <div class="col-3">
                      <input type="checkbox" class="check_off" name="off2[]" value="1" data-toggle="toggle" data-size="sm" @if ($social->off == '1') checked @endif>
                      <input type="hidden" class="off" name="off[]" @if ($social->off == '1') value="1" @else value="0" @endif>
                    </div>

                  @endif


                  @if ($social->platform == 'Youtube')

                    <!-- Youtube -->
                    <div class="input-group col-9 mb-3 px-0">
                      <div class="input-group-prepend">
                        <label for="linkedin" class="input-group-text" id="basic-addon3"><i class="fab fa-youtube"></i></label>
                        <input type="hidden" name="platform[]" value="Youtube">
                      </div>
                      <input dir="ltr" id="youtube" class="form-control" type="text" name="link[]" placeholder="Youtube Link" autocomplete="off" aria-describedby="basic-addon3" value="{{$social->link}}">
                    </div>
                    
                    <div class="col-3">
                      <input type="checkbox" class="check_off" name="off2[]" value="1" data-toggle="toggle" data-size="sm" @if ($social->off == '1') checked @endif>
                      <input type="hidden" class="off" name="off[]" @if ($social->off == '1') value="1" @else value="0" @endif>
                    </div>

                  @endif


                  @if ($social->platform == 'Telegram')

                    <!-- Telegram -->
                    <div class="input-group col-9 mb-3 px-0">
                      <div class="input-group-prepend">
                        <label for="linkedin" class="input-group-text" id="basic-addon3"><i class="fab fa-telegram"></i></label>
                        <input type="hidden" name="platform[]" value="Telegram">
                      </div>
                      <input dir="ltr" id="telegram" class="form-control" type="text" name="link[]" placeholder="Telegram Link" autocomplete="off" aria-describedby="basic-addon3" value="{{$social->link}}">
                    </div>
                    
                    <div class="col-3">
                      <input type="checkbox" class="check_off" name="off2[]" value="1" data-toggle="toggle" data-size="sm" @if ($social->off == '1') checked @endif>
                      <input type="hidden" class="off" name="off[]" @if ($social->off == '1') value="1" @else value="0" @endif>
                    </div>

                  @endif

                  @endforeach

                @endif

                  </div>
                  
                </div>
          
                <hr class="my-4">
                <!-- Save -->
                <div class="col-12 text-right">
                  <button type="submit" class="btn btn-sm btn-success submit">{{__('master.SAVE-CHANGES')}}</button>
                </div>
              </form>
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
    
<script>

    $(document).on("change",".check_off", function()
    {
      if ($(this).is(':checked')) 
      {
        $(this).parent().next('.off').val(1);
      }
      else
      {
        $(this).parent().next('.off').val(0);
      }

    });

    $('.social_form').submit(function(e)
      {
          e.preventDefault();
          $('.submit').prop('disabled', true);
          $('.error').text('');

          var head1 	= 'Done';
          var title1 	= 'Data Saved Successfully. ';
          var head2 	= 'Oops...';
          var title2 	= 'Something went wrong, please try again later.';


          $.ajax({
              url: 		"{{route('social')}}",
              method: 	'POST',
              dataType: 	'json',
              data:		$(this).serialize()	,
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

@endsection
