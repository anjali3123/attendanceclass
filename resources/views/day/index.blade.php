@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Week</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Week selection</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header text-end">
                {{-- <h3 class="card-title">Staff selection </h3> --}}
                {{-- <button type="button" class="btn btn-info  m-l-15 text-white" data-bs-toggle="modal" data-bs-target="#add-division-modal" data-whatever="@mdo"><i class="fa fa-plus-circle"></i> Create New</button> --}}
                {{-- <a href="#" class="btn btn-info  m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body p-3">
                <table class="table table-striped" id="day-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                      {{-- <th>Standerd</th> --}}
                      <th>Day</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody> 
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script>
    $(document).ready(function () {         
      var table = $('#day-details-list').DataTable({         
      processing: true,
      serverSide: true,
      responsive: false,
    
      ajax: "{{ route('day.list') }}",
      columns: [
      { data: 'DT_RowIndex', name: 'id'},
      { data: 'dayname', name: 'dayname'},
    //   { data: 'divison', name: 'divison'},  
      {data: 'action', name: 'action', orderable: false},              
      ],
    //   order: [[1, 'desc']]
      });
    });
</script>


@endsection