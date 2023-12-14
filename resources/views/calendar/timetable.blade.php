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
                    <li class="breadcrumb-item active"><a href="{{route('calendar.index')}}">Calendar</a></li>
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
            {{-- @if(auth()->user()->position != '1') --}}
            <div class="card-body p-3">
              <table class="table table-striped" id="timetable-details-list">
               
                <thead>
                    
                  <tr>
                    <th>Slot</th>
                    <th>Standerd</th>
                    <th>Subject</th>
                  </tr>
                
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
            {{-- @endif --}}
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



{{-- day modal--}}




@endsection