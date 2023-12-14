@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Standerd selection</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Standerd selection</li>
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
              
              <!-- /.card-header -->
              <div class="card-body p-3">
                <table class="table table-striped" id="standerd-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Standerd</th>
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
  <div class="modal" id="add-division-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 58%">
            <div class="modal-header">
                 <p><h4 class="modal-title d-lg"><span class="add-division-std"></span> Standerd Division</h4></p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <form action="post" id="form-add-division">
                    {{-- <input type="hidden" name="branchid" value="{{$id}}"> --}}
                    <input type="hidden" id="add-division-id" name="id" value="">
                    <input type="hidden" id="division-std"  name="standerd" value="">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label">No. of Division <span class="input-mandatory">*</span></label> 
                            <input type="text" name="div_id" id="add-divison-div" class="form-control" placeholder="Division">
                            <span class="text-danger error-msg div_id"></span>
                        </div> 
                    </div>
            </div>
            </div>
            <div class="modal-footer">                                       
                <button type="button"  onclick="adddivision()"class="btn btn-info text-white">Save</button>
                <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>                                     
            </div>
        </form>
        </div>
    </div>
  </div>  


 

  
{{--script--}}

  <script>
    $(document).ready(function () {         
      var table = $('#standerd-details-list').DataTable({         
      processing: true,
      serverSide: true,
      responsive: false,
    
      ajax: "{{ route('standerd.list') }}",
      columns: [
      { data: 'DT_RowIndex', name: 'id'},
      { data: 'standerd', name: 'standerd'},
    //   { data: 'divison', name: 'divison'},  
      {data: 'action', name: 'action', orderable: false},              
      ],
    //   order: [[1, 'desc']]
      });
    });
</script>

<script>

function get(cid){
    $.ajax({
        method : "get",
        url : '{{route("standerd.getdiv")}}',
        data : {id:cid},
        success: function(data){
            $('#add-division-id').val(data.id);
            $('.add-division-std').html(data.standerd);
            $('#division-std').val(data.standerd);
            $('#add-divison-div').val(data.div_id);
            $("#add-division-modal").modal('show');
        }
    })
  }

</script>

 <script>
    function adddivision(){
        // $.loader.on()
       var fdata = $('#form-add-division').serialize();
      $.ajax({
         method: "POST",
         url: '{{route("standerd.add")}}',
         data: fdata,
         success: function (data) {
            if (data.error == 1) {
               if (data.vderror == 1) {
                printErrorMsg(data.errors,"#add-division-modal");
               }else{
                  $("#add-division-modal").modal('hide');
                  toastr.error(data.msg,'danger');
              
                  $('#form-add-division')[0].reset();
               }
            }else{
               $("#add-division-modal").modal('hide');
               toastr.success(data.msg,'success');
          
               $('#form-add-division')[0].reset();
               $('#division-details-list').DataTable().draw();
            }
            // $.loader.off()
         },
      });
   }
</script> 

{{-- <script>

  function edit(cid){
    $.ajax({
        method : "get",
        url : '{{route("division.get")}}',
        data : {id:cid},
        success: function(data){
            $('#edit-division-id').val(data.id);
            $('#edit-divison').val(data.divison);
            $('#edit-standerdid').val(data.standerdid).trigger('change');
            $("#edit-division-modal").modal('show');
        }
    })
  }

</script> --}}
{{-- <script>

function editdivision(){
    var fdata = $('#form-edit-division').serialize();
    $.ajax({
        method : "post",
        url :'{{route("division.edit")}}',
        data :fdata,
        success: function(data){
            if(data.error == 1){
                if (data.vderror == 1) {
                    printErrorMsg(data.errors,"#edit-division-modal");
                }else{
                      $("#edit-division-modal").modal('hide');
                      toastr.error(data.msg,'danger');
                      $('#form-edit-division')[0].reset();
                   }
            }else{
                    $("#edit-division-modal").modal('hide');
                    toastr.success(data.msg,'success');
                   $('#form-edit-division')[0].reset();
                   $('#division-details-list').DataTable().draw();
            }
        }
    })
}


</script> --}}
{{-- <script>
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
          url: '{{route("division.delete")}}',
          data: {id:bid},
          success: function (data) {
             if (data.error == 1) {
              toastr.error(data.msg,'danger');
               
             }else{
              toastr.success(data.msg,'success');
             
                $('#division-details-list').DataTable().draw();
             }
            //  $.loader.off();
          },
       });
    } else if (result.isDenied) {
     
    }
 });
}
</script> --}}
@endsection