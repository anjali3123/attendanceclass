@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>calendar selection</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">calendar </li>
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

              {{-- <div class="card-header text-end"> --}}
                {{-- <h3 class="card-title">Staff selection </h3> --}}
                {{-- <a href="{{route('staff.add')}}" class="btn btn-info  m-l-15 text-white "><i class="fa fa-plus-circle"></i> Create New</a> --}}
                {{-- <a href="#" class="btn btn-info  m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a> --}}
              {{-- </div> --}}
            
              <!-- /.card-header -->
              <div class="card-body" id="calendar">
                
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

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        
        headerToolbar: {
                start: 'timeGridDay,timeGridWeek,dayGridMonth',
                center: 'title',
                end: 'prevYear,prev,next,nextYear'
                },
                footerToolbar: {
                    end: 'prev,next',
                    
                },
                selectable: true,
        
            select: function(arg) {
              // var id = date;
              $.ajax({
               method: "post",
               url: '{{route("calendar.add")}}',
               data: {date:arg.startStr},
               success: function (data) {
                // console.log("test");
               if(data.error == 1){
                Swal.fire('Your selected day is Holiyday')
               }else{
                window.location = "http://localhost/Task/attendance/public/index.php/calendar/show?date="+arg.startStr+"";
               }
              }
               });
          }, 
      });
      
      // /var/www/html/Task/attendance/resources/views/calendar/timetable.blade.php
      calendar.render();
    });

  </script>

 


  <script src='{{asset('assets')}}/fullcalendar/fullcalendar-6.1.8/dist/index.global.min.js'></script>  
@endsection