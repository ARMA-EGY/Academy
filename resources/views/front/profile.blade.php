@extends('layouts.front')

@section('style')
	<link rel="stylesheet" href="{{asset('front_assets/css/profile.css')}}">
@endsection

@section('content')

<div class="wrapper">
  <div class="profile">
    <div class="content">
      <h1>Edit Profile</h1>
      <form class="edit_profile_form">
        @csrf
        <!-- Photo -->
        <fieldset>
          <div class="grid-35">
            <label for="fname"> Name</label>
          </div>
          <div class="grid-65">
            <input type="text" value="{{$user->name}}" name="name" id="fname" tabindex="1" />
          </div>
        </fieldset>
        <!-- Phone -->
        <fieldset>
          <div class="grid-35">
            <label for="phone">Phone</label>
          </div>
          <div class="grid-65">
            <input type="number " value="{{$user->phone}}" name="phone" id="phone" />
          </div>
        </fieldset>
        <!-- Email -->
        <fieldset>
          <div class="grid-35">
            <label for="email">Email</label>
          </div>
          <div class="grid-65">
            <input type="email" value="{{$user->email}}" name="email" id="email" tabindex="6" />
          </div>
        </fieldset>
        <!-- Description about User -->
        <fieldset>
          <div class="grid-35">
            <label for="description">About you</label>
          </div>
          <div class="grid-65">
            <textarea cols="30" rows="auto" tabindex="3" name="description">{{$user->description}}</textarea>
          </div>
        </fieldset>
        
        {{-- <fieldset>
          <div class="grid-35">
            <label for="Password">Password</label>
          </div>
          <div class="grid-65">
            <input type="password" name="name" id="Password" />
          </div>
        </fieldset>
        <fieldset>
          <div class="grid-35">
            <label for="Confirm Password">Confirm Password</label>
          </div>
          <div class="grid-65">
            <input type="password" name="password_confirmation" id="Confirm Password" />
          </div>
        </fieldset> --}}
        <fieldset>
          <input type="hidden" name="id" value="{{$user->id}}" />
          <input type="submit" class="Btn submit" value="Save Changes" />
        </fieldset>

      </form>
    </div>

    <div class="content">
      <h1>Password</h1>
      <form class="change_password_form">
        @csrf
        <fieldset>
          <div class="grid-35">
            <label for="oldpassword">Old Password</label>
          </div>
          <div class="grid-65">
            <input type="password" name="oldpassword" id="oldpassword" autocomplete="new-password" required/>
          </div>
        </fieldset>
        <fieldset>
          <div class="grid-35">
            <label for="newpassword">New Password</label>
          </div>
          <div class="grid-65">
            <input type="password" name="newpassword" id="newpassword" autocomplete="new-password" required/>
          </div>
        </fieldset>
        <fieldset>
          <input type="hidden" name="id" value="{{$user->id}}" />
          <input type="submit" class="Btn submit" value="Change Password" />
        </fieldset>

      </form>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  // ==========================  Edit User Info ==========================
  $(document).on('submit', '.edit_profile_form', function(e)
	{
      e.preventDefault();
      let formData = new FormData(this);
      $('.submit').prop('disabled', true);

      $.ajax({
          url: 		"{{route('editprofile')}}",
          method: 	'POST',
          data: formData,
          contentType: false,
          processData: false,
          success : function(data)
              {
                  $('.submit').prop('disabled', false);
                  
                  if (data['status'] == 'true')
                  {
                      Swal.fire(
                              "{{__('master.DONE')}}",
                              "{{__('master.DATA-CHANGED-SUCCESSFULLY')}}",
                              'success'
                              )
                  }
                  else if (data['status'] == 'false')
                  {
                      Swal.fire(
                              "{{__('master.OOPS')}}",
                              "{{__('master.SOMETHING-WRONG')}}",
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

  // ==========================  Change Passowrd ==========================
  $(document).on('submit', '.change_password_form', function(e)
	{
        e.preventDefault();
        let formData = new FormData(this);
        $('.submit').prop('disabled', true);

        var head1 	= 'Done';
        var title1 	= 'Data Changed Successfully. ';
        var head2 	= 'Oops...';
        var title2 	= 'Something went wrong, please try again later.';

        $.ajax({
            url: 		"{{route('change-password')}}",
            method: 	'POST',
            data: formData,
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
                    else if (data['status'] == 'error')
                    {
                        Swal.fire(
                                head2,
                                data['msg'],
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
