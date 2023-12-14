@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Time Table</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('day.index')}}">week</a></li>
                    <li class="breadcrumb-item">Time Table</li>
                </ol>
                {{-- <a href="{{route('branch.add')}}" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a> --}}
                {{-- <button type="button" class="btn btn-primary d-none d-lg-block m-l-15 text-white" data-bs-toggle="modal" data-bs-target="#add-staff-modal" data-whatever="@mdo"><i class="fa fa-plus-circle"></i> Create New</button> --}}
            </div>
        </div>
        
    </div>
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            {{-- <div class="card-header text-end"> --}}
              {{-- <h3 class="card-title" id="teachere_add_day_id">-</h3> --}}
              {{-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" data-bs-toggle="modal" data-bs-target="#add-student-modal" data-whatever="@mdo"><i class="fa fa-plus-circle"></i> Create New</button> --}}
              {{-- <a href="#" class="btn btn-info  m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a> --}}
            {{-- </div> --}}
            <!-- /.card-header -->
            <div class="card-body p-3">
              <table class="table table-striped" id="timetable-details-list">
               
                <thead>
                    
                   @foreach($stds as $std)
                   <th>{{$std->standerd}}</th>
                 @endforeach
               </thead>
                <tbody> 
                    @for ($i = 1; $i <=4; $i++)
                    <tr>
                    @for($j= 1; $j <=8; $j++)
                     @foreach ($st[$i] as $value)
                     @if ($value->std_id == $j)
                     <td onclick="teachere('{{$value->id}}')" style="cursor: pointer;"><span>{{empty($value->subject->subjectname)?'-':$value->subject->subjectname}}</span><br><span style="color: rgb(93, 93, 241);">{{empty($value->user->name)?"":'('.$value->user->name.')'}}</span></td> 
                     @endif 
                     @endforeach
                     @endfor
                    </tr>
                    @endfor
                   {{-- @for ($i = 1; $i <=4; $i++)
                   <tr>
                    @foreach ($st[$i] as $value)
                    @if ($value->std_id == 1)
                    <td>{{empty($value->subject->subjectname)?'-':$value->subject->subjectname}}</td>   
                    @endif 
                    @endforeach

                    @foreach ($st[$i] as $value)
                    @if ($value->std_id == 2)
                    <td>{{empty($value->subject->subjectname)?'-':$value->subject->subjectname}}</td>   
                    @endif 
                    @endforeach
                    @foreach ($st[$i] as $value)
                    @if ($value->std_id == 3)
                    <td>{{empty($value->subject->subjectname)?'-':$value->subject->subjectname}}</td>   
                    @endif 
                    @endforeach

                    @foreach ($st[$i] as $value)
                    @if ($value->std_id == 5)
                    <td>{{empty($value->subject->subjectname)?'-':$value->subject->subjectname}}</td>   
                    @endif 
                    @endforeach

                    @foreach ($st[$i] as $value)
                    @if ($value->std_id == 5)
                    <td>{{empty($value->subject->subjectname)?'-':$value->subject->subjectname}}</td>   
                    @endif 
                    @endforeach

                    @foreach ($st[$i] as $value)
                    @if ($value->std_id == 6)
                    <td>{{empty($value->subject->subjectname)?'-':$value->subject->subjectname}}</td>   
                    @endif 
                    @endforeach

                    @foreach ($st[$i] as $value)
                    @if ($value->std_id == 7)
                    <td>{{empty($value->subject->subjectname)?'-':$value->subject->subjectname}}</td>   
                    @endif 
                    @endforeach

                    @foreach ($st[$i] as $value)
                    @if ($value->std_id == 8)
                    <td>{{empty($value->subject->subjectname)?'-':$value->subject->subjectname}}</td>   
                    @endif 
                    @endforeach
                   </tr>
                   @endfor --}}
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
</div>

{{-- teacher modal--}}
<div class="modal" id="add-teacher-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content"style="width:85%;">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Add Teacher</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <form action="post" id="form-add-teacher">
                    
                   
                    {{-- <input type="hidden" id="add-teacher-std_id" name="std_id" value="">
                    <input type="hidden" id="add-teacher-sub_id" name="sub_id" value="">
                    <input type="hidden" id="add-teacher-slot" name="slot" value=""> --}}
                    @csrf
                    <input type="hidden" id="add-teacher-id" name="id" value="">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label">Subject<span class="input-mandatory">*</span></label> 
                            {{-- <input type="text"  name="teacher_id" class="form-control" placeholder="teacher"> --}}
                              
                            <select name="sub_id" id="add-teacher-sub_id" class="form-control adi-select2">
                              <option value="">Select One</option>
                              @foreach ($sub as $key)
                              <option value="{{$key->id}}" {{(old('sub_id') == $key->id)?'selected':''}}>{{$key->subjectname}}</option>
                              @endforeach
                            </select>
                            <span class="text-danger error-msg sub_id"></span>
                        </div> 
                    </div>
                      </div>
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label class="form-control-label">Teacher  <span class="input-mandatory">*</span></label> 
                          {{-- <input type="text"  name="teacher_id" class="form-control" placeholder="teacher"> --}}
                            
                          <select name="teacher_id" id="add-teacher-teacher_id" class="form-control adi-select2">
                            <option value="">Select One</option>
                            @foreach ($tech as $key)
                            <option value="{{$key->id}}" {{(old('teacher_id') == $key->id)?'selected':''}}>{{$key->name}}</option>
                            @endforeach
                          </select>
                          <span class="text-danger error-msg teacher_id"></span>
                      </div> 
                  </div>
                    </div>
            </div>
            <div class="modal-footer">                                       
                <button type="button" onclick="addtech()" class="btn btn-info text-white">Save</button>
                <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>                                     
            </div>
        </form>
        </div>
    </div>
  </div> 


{{-- day modal--}}


 <script>
function teachere(cid){
    $.ajax({
        method : "get",
        url : '{{route("timetable.get")}}',
        data : {id:cid},
        success: function(data){
            
            $('#add-teacher-id').val(data.id);
            // $('#teachere_add_day_id').html(data.day_id);
            $('#add-teacher-sub_id').val(data.sub_id).trigger('change');
            $('#add-teacher-teacher_id').val(data.teacher_id).trigger('change');
            // if(data.sub_id != null){
            $("#add-teacher-modal").modal('show');
            // }else{
            //     $("#add-teacher-modal").modal('hide');
            // }
        }
    })
}

</script>
<script>
function addtech(){
    var fdata = $('#form-add-teacher').serialize();
      $.ajax({
         method: "POST",
         url: '{{route("timetable.store")}}',
         data: fdata,
         success: function (data) {
            if (data.error == 1) {
               if (data.vderror == 1) {
                printErrorMsg(data.errors,"#add-teacher-modal");
               }else{
                  $("#add-teacher-modal").modal('hide');
                  toastr.error(data.msg,'danger');
              
                  $('#form-add-division')[0].reset();
               }
            }else{
               $("#add-teacher-modal").modal('hide');
               toastr.success(data.msg,'success');
          
               $('#form-add-teacher')[0].reset();
               
               location.reload();
            }
            // $.loader.off()
         },
      });
}



</script>


@endsection