@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Division selection</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Division selection</li>
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
                <button type="button" class="btn btn-info  m-l-15 text-white" data-bs-toggle="modal" data-bs-target="#add-division-modal" data-whatever="@mdo"><i class="fa fa-plus-circle"></i> Create New</button>
                {{-- <a href="#" class="btn btn-info  m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body p-3">
                <table class="table table-striped" id="division-details-list">
                  <thead>
                    <tr>
                      <th>#</th>
                      {{-- <th>Standerd</th> --}}
                      <th>Division</th>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content"style="width:85%;">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Add Division</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <form action="post" id="form-add-division">
                    
                    <input type="hidden" id="add-division-id" name="id" value="">
                    @csrf
                    <div class="row">
                      
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Standerd <span class="input-mandatory">*</span></label>                         
                            <select name="standerdid" id="standerdid" class="form-control adi-modal-select2">
                                <option value="">Select One</option>
                                @foreach ($standerd as $key)
                                <option value="{{$key->id}}" {{(old('standerdid') == $key->id)?'selected':''}}>{{$key->standerd}}</option>
                                @endforeach                         
                            </select>
                            <span class="text-danger error-msg standerdid"></span>
                        </div> 
                    </div>  --}}

                    <div class="col-md-12">
                      <div class="form-group">
                          <label class="form-control-label">Division <span class="input-mandatory">*</span></label> 
                          <input type="text" name="divison" class="form-control" placeholder="Division">
                          <span class="text-danger error-msg divison"></span>
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

  {{--edit--}}


  <div class="modal" id="edit-division-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content"style="width:150%;">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Edit Division</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <form action="post" id="form-edit-division">
                    
                    <input type="hidden" id="edit-division-id" name="id" value="">
                    @csrf
                    <div class="row">
                {{--                       
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Standerd <span class="input-mandatory">*</span></label>                         
                            <select name="standerdid" id="edit-standerdid" class="form-control adi-modal-select2">
                                <option value="">Select One</option>
                                @foreach ($standerd as $key)
                                <option value="{{$key->id}}" {{(old('standerdid') == $key->id)?'selected':''}}>{{$key->standerd}}</option>
                                @endforeach                         
                            </select>
                            <span class="text-danger error-msg standerdid"></span>
                        </div> 
                    </div>  --}}
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="form-control-label">Division <span class="input-mandatory">*</span></label> 
                          <input type="text" name="divison" id="edit-divison" class="form-control" placeholder="Division">
                          <span class="text-danger error-msg divison"></span>
                      </div> 
                  </div>
                    </div>
            </div>
            <div class="modal-footer">                                       
                <button type="button"  onclick="editdivision()"class="btn btn-info text-white">Save</button>
                <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>                                     
            </div>
        </form>
        </div>
    </div>
  </div> 

  
{{--script--}}

  <script>
    $(document).ready(function () {         
      var table = $('#division-details-list').DataTable({         
      processing: true,
      serverSide: true,
      responsive: false,
    
      ajax: "{{ route('division.list') }}",
      columns: [
      { data: 'DT_RowIndex', name: 'id'},
      // { data: 'standerdid', name: 'standerdid'},
      { data: 'divison', name: 'divison'},  
      {data: 'action', name: 'action', orderable: false},              
      ],
    //   order: [[1, 'desc']]
      });
    });
</script>


<script>
    function adddivision(){
        // $.loader.on()
       var fdata = $('#form-add-division').serialize();
      $.ajax({
         method: "POST",
         url: '{{route("division.store")}}',
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

<script>

  function edit(cid){
    $.ajax({
        method : "get",
        url : '{{route("division.get")}}',
        data : {id:cid},
        success: function(data){
            $('#edit-division-id').val(data.id);
            $('#edit-divison').val(data.divison);
            // $('#edit-standerdid').val(data.standerdid).trigger('change');
            $("#edit-division-modal").modal('show');
        }
    })
  }

</script>
<script>

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
</script>
@endsection