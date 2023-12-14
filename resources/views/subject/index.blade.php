@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Subject </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Subject </li>
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
                <button type="button" class="btn btn-info  m-l-15 text-white" data-bs-toggle="modal" data-bs-target="#add-subject-modal" data-whatever="@mdo"><i class="fa fa-plus-circle"></i> Create New</button>
                {{-- <a href="#" class="btn btn-info  m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body p-3">
                <table class="table table-striped" id="subject-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                      {{-- <th>Standerd</th> --}}
                      <th>Subject</th>
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



  <div class="modal" id="add-subject-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content"style="width:77%;">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Add subject</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <form action="post" id="form-add-subject">
                    
                    <input type="hidden" id="add-subject-id" name="id" value="">
                    @csrf
                    <div class="row">
                      <div class="col-md-10">
                        <div class="form-group">
                            <label class="form-control-label">Subject Name <span class="input-mandatory">*</span></label> 
                            <input type="text" name="subjectname" class="form-control" placeholder="Subject Name">
                            <span class="text-danger error-msg subjectname"></span>
                        </div> 
                    </div>
                    
                    </div>
            </div>
            <div class="modal-footer">                                       
                <button type="button"  onclick="addsubject()"class="btn btn-info text-white">Save</button>
                <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>                                     
            </div>
        </form>
        </div>
    </div>
  </div> 

  {{--edit--}}


  <div class="modal" id="edit-subject-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content"style="width:77%;">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Edit subject</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <form action="post" id="form-edit-subject">
                    
                    <input type="hidden" id="edit-subject-id" name="id" value="">
                    @csrf
                    <div class="row">
                      <div class="col-md-10">
                        <div class="form-group">
                            <label class="form-control-label">Subject Name <span class="input-mandatory">*</span></label> 
                            <input type="text" name="subjectname" id="edit-subjectname" class="form-control" placeholder="Subject Name">
                            <span class="text-danger error-msg subjectname"></span>
                        </div> 
                    </div>
                    
                    </div>
            </div>
            <div class="modal-footer">                                       
                <button type="button"  onclick="editsubject()"class="btn btn-info text-white">Save</button>
                <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>                                     
            </div>
        </form>
        </div>
    </div>
  </div> 


  <script>
    $(document).ready(function () {         
      var table = $('#subject-details-list').DataTable({         
      processing: true,
      serverSide: true,
      responsive: false,
    
      ajax: "{{ route('subject.list') }}",
      columns: [
      { data: 'DT_RowIndex', name: 'id'},
      // { data: 'standerdid', name: 'standerdid'},
      { data: 'subjectname', name: 'subjectname'},  
      {data: 'action', name: 'action', orderable: false},              
      ],
    //   order: [[1, 'desc']]
      });
    });
</script>


<script>
    function addsubject(){
        // $.loader.on()
       var fdata = $('#form-add-subject').serialize();
      $.ajax({
         method: "POST",
         url: '{{route("subject.store")}}',
         data: fdata,
         success: function (data) {
            if (data.error == 1) {
               if (data.vderror == 1) {
                printErrorMsg(data.errors,"#add-subject-modal");
               }else{
                  $("#add-subject-modal").modal('hide');
                  appct.clearErrors("#add-subject-modal");
                  toastr.error(data.msg,'danger');
                  
                  
                //   $.toast.notify(data.msg,'danger');
                  $('#form-add-subject')[0].reset();
               }
            }else{
               $("#add-subject-modal").modal('hide');
               appct.clearErrors("#add-subject-modal");
               toastr.success(data.msg,'success');
               
            //   $.toast.notify(data.msg,'success');
               $('#form-add-subject')[0].reset();
               $('#subject-details-list').DataTable().draw();
            }
            // $.loader.off()
         },
      });
   }
</script>

<script>

  function edit(cid){
    $.ajax({
        method : "get",
        url : '{{route("subject.get")}}',
        data : {id:cid},
        success: function(data){
            $('#edit-subject-id').val(data.id);
            $('#edit-subjectname').val(data.subjectname);
            $('#edit-standerdid').val(data.standerdid).trigger('change');
            $("#edit-subject-modal").modal('show');
        }
    })
  }

</script>
<script>

function editsubject(){
    var fdata = $('#form-edit-subject').serialize();
    $.ajax({
        method : "post",
        url :'{{route("subject.edit")}}',
        data :fdata,
        success: function(data){
            if(data.error == 1){
                if (data.vderror == 1) {
                    printErrorMsg(data.errors,"#edit-subject-modal");
                }else{
                      $("#edit-subject-modal").modal('hide');
                      toastr.error(data.msg,'danger');
                    //   $.toast.notify(data.msg,'danger');
                      $('#form-edit-subject')[0].reset();
                   }
            }else{
                $("#edit-subject-modal").modal('hide');
                toastr.success(data.msg,'success');
                //    $.toast.notify(data.msg,'success');
                   $('#form-edit-subject')[0].reset();
                   $('#subject-details-list').DataTable().draw();
            }
        }
    })
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
//    $.loader.on();
       $.ajax({
          method: "post",
          url: '{{route("subject.delete")}}',
          data: {id:bid},
          success: function (data) {
             if (data.error == 1) {
                toastr.error(data.msg,'danger');
             }else{
                toastr.success(data.msg,'success');
                $('#subject-details-list').DataTable().draw();
             }
            //  $.loader.off();
          },
       });
    } else if (result.isDenied) {
     
    }
 });
}
</script>
@endsection