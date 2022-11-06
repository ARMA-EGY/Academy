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
                  <li class="breadcrumb-item active" aria-current="page">Courses Requests</li>
                </ol>
              </nav>
            </div>


            @if(session()->has('success'))	
                <div class="alert alert-success alert-dismissible fade show m-auto" role="alert">
                    {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif

          </div>
        </div>
      </div>
    </div>
    <!-- End: Header -->


    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">All Courses Requests <span class="badge badge-primary p-2">{{$total_rows}}</span></h3>
                </div>
              </div>
            </div>

            @if ($items->count() > 0)

            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush display nowrap" id="example">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="sort" >{{__('master.NAME')}}</th>
                    <th scope="col" class="sort" >Email</th>
                    <th scope="col" class="sort" >Phone</th>
                    <th scope="col" class="sort" >Company </th>
                    <th scope="col" class="sort" >Position</th>
                    <th scope="col" class="sort" >Course</th>
                    <th scope="col" class="sort" >Country </th>
                    <th scope="col" class="sort" >Payment Method </th>
                    <th scope="col" class="sort" >Online Payment </th>
                    <th scope="col">Accept</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($items as $item)

                  <tr class="parent">
                    <td>{{ $loop->iteration }}</td>
                    <td><strong> {{  $item->name }} </strong></td>
                    <td><strong> {{ $item->email }} </strong></td>
                    <td><strong> {{ $item->phone }} </strong></td>
                    <td><strong> {{ $item->company }} </strong></td>
                    <td><strong> {{ $item->position }} </strong></td>
                    <td><strong> {{ $item->course->name }} </strong></td>
                    <td><strong> {{__('master.'.$item->country)}} </strong></td>
                    <td><strong> {{ $item->payment_method }} </strong></td>
                    <td><strong> @if ($item->payed == 1) Done @else - @endif </strong></td>
                    <td>
                      <div class="col-3">
                        <input type="checkbox" class="check_off item_request" data-id="{{$item->id}}" data-url="{{route('course-request-accept')}}" data-toggle="toggle" data-size="sm"  @if ($item->accept == '1') checked @endif>
                      </div>
                    </td>
                  </tr>

                  @endforeach
                 
                </tbody>
              </table>
            </div>


            @else 
                <p class="text-center"> No Requests Available </p>
            @endif

            <!-- Card footer -->
            <div class="card-footer py-2">
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
   

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


<script>

$('#example').DataTable( {
    "pagingType": "numbers"
  } );

</script>
    
@endsection