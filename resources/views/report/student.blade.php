@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Student</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item">Student</li>
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
                <div class="card-header">
                  <h3 class="card-title">
                    <i class=" fas fa-user-graduate"></i>
                    Student report
                  </h3>
                  <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        @if (!$errors->has('from_date'))
                        @if ($student->count() > 0)                         
                        <a href="{{route('report.studentexport',$requ)}}" class="btn btn-info text-white">Export</a>
                        @endif
                        @endif
                      </li>                     
                    </ul>
                  </div>
                  {{-- <div class="text-end col-md-4" >
                    @if (!$errors->has('from_date'))
                    @if ($list->count() > 0)                                                     
                    <a href="{{route('report.export',$requ)}}" class="btn btn-info text-white">Export</a>
                    @endif
                    @endif
                </div> --}}
                  <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                    </ul>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body"> 
                    {{-- <a class="card-header"> --}}
                        <button type="button" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                            <h5 class="mb-0"><b>Search</b></h5>
                        </button>
                    {{-- </a>   --}}
                    <div id="collapse1" class="collapse" aria-labelledby="contactreport" data-parent="#contactreport">
                        <div class="row">
                          <div class="col-12">                                               
                                      <form class="form-control-line" id="search_form" action ="{{route('report.student')}}" method="get">
                                          <div class="row">
                                            <div class="col-md-4">                                                              
                                              <div class="form-group">
                                                  <label class="form-label">From Date</label>
                                                  <input type="date" name="from_date" value="{{old('from_date',empty($requ['from_date'])?'':$requ['from_date'])}}" class="form-control date-picker">                                                 
                                              </div>
                                            </div>
                                            <div class="col-md-4">
                                              <div class="form-group">
                                                  <div class="form-group">
                                                      <label class="form-label">To date</label>
                                                      <input type="date" name="to_date" value="{{old('to_date',empty($requ['to_date'])?'':$requ['to_date'])}}" class="form-control date-picker">
                                                  </div>   
                                            </div> 
                                         </div>  
                                              <div class="col-md-4">
                                                <div class="form-group ">
                                                    <label class="form-control-label">Standerd</label>
                                                    @php
                                                        $requ['standname'] = empty($requ['standname'])?'':$requ['standname'];
                                                    @endphp
                                                    <select name="standname" class="form-control">
                                                      <option value="">All Standerd</option>
                                                      @foreach ($stander as $key)  
                                                      <option value="{{$key->standerd}}"  {{($requ['standname'] == $key->standerd)?'selected':''}}>{{$key->standerd}}</option>
                                                      @endforeach
                                                    </select>
                                           
                                                </div>
                                                </div> 
                                            </div>
                                            {{-- <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Standerd">Division</label>
                                                        @php
                                                        $requ['divisionid'] = empty($requ['divisionid'])?'':$requ['divisionid'];
                                                        @endphp
                                                        <select name="divisionid" id="div-select" class="form-control">
                                                            <option value="">All division</option>
                                                          @foreach ($division as $key)  
                                                          <option value="{{$key->divi}}" {{($requ['divisionid']== $key->divi)?'selected':''}}>{{$key->divi}}</option>
                                                          @endforeach                                 
                                                        </select>                         
                                                      </div>
                                                    </div> 
                                            </div>                                                                                                                                                                                                                                                                          </div> --}}
                                          <hr>
                                          <button type="submit" class="btn btn-info text-white">Search</button>
                                          <a href="{{route('report.student')}}" class="btn btn-primary text-white">Reset</a>
                                      </form>
                                  </div>
                              </div>
                          </div>  
                          @if (!$errors->has('from_date'))
                            @if ($student->count() > 0)            
                  <table id="student-details-list" class="table table-bordered table-hover">
                    <thead>
                      <tr>                          
                        <th>Created at</th>
                        <th>Name</th>                        
                        <th>Roll No</th>
                        <th>G.R number</th>
                        <th>Standerd</th> 
                        <th>Division</th>                                               
                      </tr>                                             
                  </thead>
                  <tbody>
                    @foreach ($student as $lists)
                    <tr>  
                        <td>{{date('d-m-Y',strtotime($lists->created_at)) }}</td>        
                        <td>{{$lists->name}}</td>
                        <td>{{ $lists->roll_no}}</td> 
                        <td>{{ $lists->id}}</td>
                        <td>{{ $lists->standerd->standerd}}</td>
                        <td>{{ $lists->subname}}</td>                           
                        {{-- <td>{{( empty($lists->divison->divison)?'':$lists->divison->divison)}}</td>                            --}}
                                                                             
                    </tr>
                   @endforeach   
                  </tbody>
                </div>
                <!-- /.card-body -->
              </div>           
            </table>
            {!! $student->onEachSide(5)->links() !!}
          </div>
         
          <!-- /.card-body -->
        </div>
        @else
        <div class="alert adi-alert alert-danger alert-dismissible fade show" role="alert">
            <strong>No data found</strong>
        </div>
        @endif

        @endif
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
</div>
@endsection