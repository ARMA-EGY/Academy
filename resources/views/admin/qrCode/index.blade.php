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
                  <li class="breadcrumb-item active" aria-current="page">Qr Code List</li>
                </ol>
              </nav>
            </div>

            <div class="col-lg-6 col-5 text-right">
              <a href="{{ route('qrcode.create')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('master.ADD-NEW-COURSE')}}</a>
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
                  <h3 class="mb-0"> All qrcode <span class="badge badge-primary p-2">{{$total_rows}}</span></h3>
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
                    <th scope="col" class="sort" >title</th>
                    <th scope="col" class="sort" >description</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                  <tr class="parent">
                    <td>{{$item->id}}</td>
                    <td><strong> {{  $item->title }} </strong></td>
                    <td><strong> {{ $item->description }} </strong></td>

                    <td>
                      <a data-toggle="tooltip" data-placement="top" href="{{ route('qrcode.delete', $item->id)}}" class="btn btn-danger btn-sm mx-1 px-3"> <i class="fa fa-trash"></i> </a>
                      <a data-toggle="tooltip" data-placement="top" title="{{__('master.EDIT')}}" href="{{ route('qrcode.edit', $item->id)}}" class="btn btn-secondary btn-sm mx-1 px-3"> <i class="fa fa-edit"></i> </a>
                    </td>
                  </tr>

                  @endforeach

                </tbody>
              </table>
            </div>

            @else
                <p class="text-center"> No Data Available </p>
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
