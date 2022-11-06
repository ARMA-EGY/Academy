@extends('layouts.master')


@section('style')

<style>

  .pointer {
    cursor: pointer;
  }
  /* EMAIL */
  .email {
      padding: 20px 10px 15px 10px;
    font-size: 1em;
  }
  
  .email .btn.search {
    font-size: 0.9em;
  }
  
  .email h2 {
    margin-top: 0;
    padding-bottom: 8px;
  }
  
  .email .nav.nav-pills > li > a {
    border-top: 3px solid transparent;
  }
  
  .email .nav.nav-pills > li > a > .fa {
    margin-right: 5px;
    margin-left: 5px;
  }
  
  .email .nav.nav-pills > li.active > a,
  .email .nav.nav-pills > li.active > a:hover {
    background-color: #f6f6f6;
    border-top-color: #3c8dbc;
  }
  
  .email .nav.nav-pills > li.active > a {
    font-weight: 600;
  }
  
  .email .nav.nav-pills > li > a:hover {
    background-color: #f6f6f6;
  }
  
  .email .nav.nav-pills.nav-stacked > li > a {
    color: #666;
    border-top: 0;
    border-left: 3px solid transparent;
    border-radius: 0px;
  }
  
  .email .nav.nav-pills.nav-stacked > li.active > a,
  .email .nav.nav-pills.nav-stacked > li.active > a:hover {
    background-color: #f6f6f6;
    border-left-color: #3c8dbc;
    color: #444;
  }
  
  .email .nav.nav-pills.nav-stacked > li.header {
    color: #777;
    text-transform: uppercase;
    position: relative;
    padding: 0px 0 10px 0;
  }
  
  .email table {
    font-weight: 600;
  }
  
  .email table a {
    color: #666;
  }
  
  .email table tr.read > td {
    background-color: #f6f6f6;
  }
  
  .email table tr.read > td {
    font-weight: 400;
  }
  
  .email table tr td > i.fa {
    font-size: 1.2em;
    line-height: 1.5em;
    text-align: center;
  }
  
  .email table tr td > i.fa-star {
    color: #f39c12;
  }
  
  .email table tr td > i.fa-bookmark {
    color: #e74c3c;
  }
  
  .email table tr > td.action {
    padding-left: 0px;
    padding-right: 2px;
  }
  
  .grid {
      position: relative;
      width: 100%;
      background: #fff;
      color: #666666;
      border-radius: 5px;
      margin-bottom: 25px;
      box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.2);
  }
  
  
  .grid .grid-header:after {
      clear: both;
  }
  
  .grid .grid-header span,
  .grid .grid-header > .fa {
      display: inline-block;
      margin: 0;
      font-weight: 300;
      font-size: 1.5em;
  }
  
  .grid .grid-header span {
      padding: 0 5px;
  }
  
  .grid .grid-header > .fa {
      padding: 5px 10px 0 0;
  }
  
  .grid .grid-header > .grid-tools {
      padding: 4px 10px;
  }
  
  .grid .grid-header > .grid-tools a {
      color: #999999;
      padding-left: 10px;
      cursor: pointer;
  }
  
  .grid .grid-header > .grid-tools a:hover {
      color: #666666;
  }
  
  .grid .grid-body {
      padding: 15px 20px 15px 20px;
      font-size: 0.9em;
      line-height: 1.9em;
  }
  
  .grid .full {
      padding: 0 !important;
  }
  
  .grid .transparent {
      box-shadow: none !important;
      margin: 0px !important;
      border-radius: 0px !important;
  }
  
  .grid.top.black > .grid-header {
      border-top-color: #000000 !important;
  }
  
  .grid.bottom.black > .grid-body {
      border-bottom-color: #000000 !important;
  }
  
  .grid.top.blue > .grid-header {
      border-top-color: #007be9 !important;
  }
  
  .grid.bottom.blue > .grid-body {
      border-bottom-color: #007be9 !important;
  }
  
  .grid.top.green > .grid-header {
      border-top-color: #00c273 !important;
  }
  
  .grid.bottom.green > .grid-body {
      border-bottom-color: #00c273 !important;
  }
  
  .grid.top.purple > .grid-header {
      border-top-color: #a700d3 !important;
  }
  
  .grid.bottom.purple > .grid-body {
      border-bottom-color: #a700d3 !important;
  }
  
  .grid.top.red > .grid-header {
      border-top-color: #dc1200 !important;
  }
  
  .grid.bottom.red > .grid-body {
      border-bottom-color: #dc1200 !important;
  }
  
  .grid.top.orange > .grid-header {
      border-top-color: #f46100 !important;
  }
  
  .grid.bottom.orange > .grid-body {
      border-bottom-color: #f46100 !important;
  }
  
  .grid.no-border > .grid-header {
      border-bottom: 0px !important;
  }
  
  .grid.top > .grid-header {
      border-top-width: 4px !important;
      border-top-style: solid !important;
  }
  
  .grid.bottom > .grid-body {
      border-bottom-width: 4px !important;
      border-bottom-style: solid !important;
  }
    
  
   .inbox .message.unread .header,
   .inbox .message.unread .title {
      font-weight: bold;
  }
  
  .inbox .message .header {
      display: flex;
      flex-direction: row;
      margin-bottom: 0.5rem;
  }
  
   .inbox .message .header .date {
      margin-left: auto;
  }
  
   .inbox .message .title {
      margin-bottom: 0.5rem;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
  }
  
   .inbox .message .description {
      font-size: 12px;
  }
  
   .message .toolbar {
      padding-bottom: 1rem;
      border-bottom: 1px solid #e1e6ef;
  }
  
   .message .details .title1 {
      padding: 1rem 0;
      font-weight: bold;
  }
  
   .message .details .header {
      display: flex;
      padding: 1rem 0;
      margin: 1rem 0;
      border-top: 1px solid #e1e6ef;
      border-bottom: 1px solid #e1e6ef;
  }
  
   .message .details .header .avatar {
      width: 40px;
      height: 40px;
      margin-right: 1rem;
  }
  
   .message .details .header .from {
      font-size: 12px;
      color: #9faecb;
      align-self: center;
  }
  
   .message .details .header .from span {
      display: block;
      font-weight: bold;
  }
  
   .message .details .header .date {
      margin-left: auto;
  }
  
   .message .details .attachments {
      padding: 1rem 0;
      margin-bottom: 1rem;
      border-top: 3px solid #f9f9fa;
      border-bottom: 3px solid #f9f9fa;
  }
  
   .message .details .attachments .attachment {
      display: flex;
      margin: 0.5rem 0;
      font-size: 12px;
      align-self: center;
  }
  
   .message .details .attachments .attachment .badge {
      margin: 0 0.5rem;
      line-height: inherit;
  }
  
   .message .details .attachments .attachment .menu {
      margin-left: auto;
  }
  
   .message .details .attachments .attachment .menu a {
      padding: 0 0.5rem;
      font-size: 14px;
      color: #e1e6ef;
  }
  
  @media (max-width: 575px) {
       .message .header {
          flex-flow: row wrap;
      }
       .message .header .date {
          flex: 0 0 100%;
      }
  }
  
</style>

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
                  <li class="breadcrumb-item active" aria-current="page"> Messages</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral get_receiver_email"> Recipient Email</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End: Header -->


    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-md-12">
          <div class="grid email">
            <div class="grid-body">
              <div class="row">
                <!-- BEGIN INBOX MENU -->
                <div class="col-md-3">
                  <h2 class="grid-title"><i class="fa fa-inbox"></i> Inbox</h2>
                  

                  <hr>

                  <div>
                    <ul class="nav nav-pills nav-stacked">
                      <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox ({{$messages->total()}})</a></li>
                    </ul>
                  </div>
                </div>
                <!-- END INBOX MENU -->

                <!-- BEGIN INBOX CONTENT -->
                <div class="col-md-9">
                  

                  <div class="padding"></div>

                @if ($messages->count() > 0)

                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                                 
                  @foreach ($messages as $message)

                          <tr  class="parent @if($message->open == 0) read @endif">
                            <td class="action"><div class="icheckbox_square-blue" ><input type="checkbox"></div></td>
                            <td class="name">
                              <a class="get_msg pointer" data-id="{{$message->id}}">{{$message->name}}</a>
                            </td>
                            <td class="subject">
                              <a class="get_msg pointer" data-id="{{$message->id}}">{{ \Illuminate\Support\Str::limit(strip_tags($message->message), 50, '...') }}</a>
                            </td>
                            <td class="time2">{{  date('j M, Y', strtotime($message->created_at))  }}</td>
                          </tr>   


                  @endforeach
                                            
                      </tbody>
                    
                     </table>
                  </div>

                  <!-- Card footer -->
                  <div class="card-footer py-4">
                    {{$messages->links()}}
                    <div class="col-12">
                      Showing {{($messages->currentPage()-1)* $messages->perPage()+($messages->total() ? 1:0)}} to {{($messages->currentPage()-1)*$messages->perPage()+count($messages)}}  of  {{$messages->total()}}  Results
                    </div>
                  </div>

                  @else 
                      <p class="text-center"> No Data Available</p>
                  @endif

                </div>
                <!-- END INBOX CONTENT -->

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
    
<script>

$('.get_receiver_email').click(function()
  {

    $('#popup').modal('show');
    $('#modal_body').html('<div class="divload"><img src="/images/load.gif" width="50" class="m-auto"></div>');

    $.ajax({
         url:"{{route('getreceiveremail')}}",
         type:"POST",
         dataType: 'text',
         data:    {"_token": "{{ csrf_token() }}"},
          success : function(response)
            {
              $('#modal_body').html(response);
            }  
        })

  });

$('.get_msg').click(function()
  {
		var id 	= $(this).attr('data-id');
    $(this).parents('.parent').removeClass('read');

    $('#popup').modal('show');
    $('#modal_body').html('<div class="divload"><img src="/images/load.gif" width="50" class="m-auto"></div>');

    $.ajax({
         url:"{{route('getmessage')}}",
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

$(document).on('submit', '.receiver_email_form', function(e)
	{
        e.preventDefault();
        $('.submit').prop('disabled', true);

        var head1 	= 'Done';
        var title1 	= 'Data Changed Successfully. ';
        var head2 	= 'Oops...';
        var title2 	= 'Something went wrong, please try again later.';


        $.ajax({
            url: 		"{{route('receiveremail')}}",
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
