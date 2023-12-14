@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li> --}}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              {{-- <div class="card-header text-end"> --}}
               
                {{-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white" data-bs-toggle="modal" data-bs-target="#add-student-modal" data-whatever="@mdo"><i class="fa fa-plus-circle"></i> Create New</button> --}}
                {{-- <a href="#" class="btn btn-info  m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a> --}}
              {{-- </div> --}}
              <!-- /.card-header -->
              @if(auth()->user()->position != '1')
              <div class="card-body p-3">
                <table class="table table-striped" id="timetable-details-list">
                 
                  <thead>
                     <th>slot</th>
                     <th>Standerd</th>
                     <th>Subject</th>
                 </thead>
                  <tbody> 
                    @foreach ($dashcount as $value)
                      <tr>
                     
                     <td>{{empty($value->slot)?"":$value->slot}}</td> 
                     <td>{{empty($value->standerd->standerd)?"":$value->standerd->standerd}}</td> 
                     <td>{{empty($value->subject->subjectname)?'-':$value->subject->subjectname}}</td> 
                    
                       
                      
                      </tr>
                      @endforeach
                     
                     
                  </tbody>
                </table>
               
              </div>
              @endif
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
  
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        @if(auth()->user()->position != '2')
        <div class="row" id="dashboard">

          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                
                <h3 class="m-b-0" id="users">-</h3>            
                <p>Total No. of User</p>
              </div>
              <div class="icon">
              <!-- <i class="ion ion-bag"></i> -->
              </div>
            </div>
          </div>
          <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="enabled_users">-</h3>

                <p>Total No. of Enabled User</p>
              </div>
              <div class="icon">
                {{-- <i class="ion ion-stats-bars"></i> --}}
              </div>
              
            </div>
          </div> 
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="standers">-</h3>

                <p>Total No. of Standers</p>
              </div>
              <div class="icon">
                {{-- <i class="ion ion-person-add"></i> --}}
              </div>
             
            </div>
          </div> 
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="subjects">-</h3>

                <p>Total No. of Subjects</p>
              </div>
              <div class="icon">
                {{-- <i class="ion ion-pie-graph"></i> --}}
              </div>
             
            </div>
          </div> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="teacher">-</h3>

                <p>Total No. of Teacher</p>
              </div>
              <div class="icon">
                {{-- <i class="ion ion-pie-graph"></i> --}}
              </div>
             
            </div>
          </div>
          <!-- ./col -->
        </div>
        @endif
        <!-- /.row -->
        <!-- Main row -->
        
          <!-- Left col -->
         
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
          <!-- right col -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script>
function get(){
 var id = $("#dashboard").val();
 $.ajax({
  method: "Post",
  url: '{{route("dashboard.get")}}',
  data: {id:id},
  success: function (data) {
    $("#users").text(data.users);
    $("#enabled_users").text(data.enabled_users);
    $("#standers").text(data.standers);
    $("#subjects").text(data.subjects);
    $("#teacher").text(data.teacher);
  },
 });
}
  </script>
  <script>
    $(document).ready(function () {
       get();
    }); 
 </script> 
@endsection