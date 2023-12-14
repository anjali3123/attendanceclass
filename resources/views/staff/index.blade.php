@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Staff selection</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Staff selection</li>
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
                <a href="{{route('staff.add')}}" class="btn btn-info  m-l-15 text-white "><i class="fa fa-plus-circle"></i> Create New</a>
                {{-- <a href="#" class="btn btn-info  m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a> --}}
              </div>
            
              <!-- /.card-header -->
              <div class="card-body p-3 table-responsive">
                <table class="table nowrap table-striped" id="staff-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Position</th>
                      <th>Contact No.</th>
                      <th>Status</th>
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
      var table = $('#staff-details-list').DataTable({         
      processing: true,
      serverSide: true,
      responsive: false,
    
      ajax: "{{ route('staff.list') }}",
      columns: [
      { data: 'DT_RowIndex', name: 'id'},
      { data: 'name', name: 'name'},
      { data: 'username', name: 'username'}, 
      { data: 'email', name: 'email'}, 
      { data: 'position', name: 'position'}, 
      { data: 'contactno', name: 'contactno'}, 
      { data: 'status', name: 'status'}, 
      {data: 'action', name: 'action', orderable: false},              
      ],
    //   order: [[1, 'desc']]
      });
    });
</script>
<script>
  function changestatus(bid) {
Swal.fire({
   title: 'Are you sure you want to change the status of this Staff?',
   showDenyButton: false,
   showCancelButton: true,
   confirmButtonText: 'Okay',
}).then((result) => {
   if (result.isConfirmed) {
  // $.loader.on();
      $.ajax({
         method: "post",
         url: '{{route("staff.status")}}',
         data: {id:bid},
         success: function (data) {
            if (data.error == 1) {
              toastr.error(data.msg,'danger');
              //  $.Toast.fire(data.msg,'danger');
            }else{
              toastr.success(data.msg,'success');
              //  $.Toast.fire(data.msg,'success');
               $('#staff-details-list').DataTable().draw();
            }
          //   $.loader.off();
         },
      });
   } else if (result.isDenied) {
    
   }
});
}
</script>
<script>
  function departdeleted(bid) {
Swal.fire({
   title: 'Are you sure you want to delete this?',
   showDenyButton: false,
   showCancelButton: true,
   confirmButtonText: 'Okay',
}).then((result) => {
   if (result.isConfirmed) {
  // $.loader.on();
      $.ajax({
         method: "post",
         url: '{{route("staff.delete")}}',
         data: {id:bid},
         success: function (data) {
            if (data.error == 1) {
              toastr.error(data.msg,'danger');
             
            }else{
               toastr.success(data.msg,'success');
               $('#staff-details-list').DataTable().draw();
            }
          //   $.loader.off();
         },
      });
   } else if (result.isDenied) {
    
   }
});
}
</script>
@endsection