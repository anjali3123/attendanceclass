@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('student.index')}}">Student Details</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              {{-- <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div> --}}
              <!-- /.card-header -->
              <!-- form start -->
              
                <div class="card-body">
                    <form action="{{route('student.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="name">Name <span class="input-mandatory">*</span></label>
                                  <input type="name" name="name" value ="{{old('name')}}" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                                  @if ($errors->has('name'))
                                  <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="email">Email <span class="input-mandatory">*</span></label>
                                  <input type="text" name="email" value ="{{old('email')}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                                  @if ($errors->has('email'))
                                  <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="contactno">Phone No. <span class="input-mandatory">*</span></label>
                                  <input type="text" name="contactno" value ="{{old('contactno')}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone No.">
                                  @if ($errors->has('contactno'))
                                  <div class="text-danger">{{ $errors->first('contactno') }}</div>
                                @endif
                                </div>
                              </div>
                              {{-- <div class="col-md-4">
                                <div class="form-group">
                                  <label class="form-control-label">Date of Birth <span class="input-mandatory">*</span></label>
                                  <input type="date" class="form-control"  name="dob" id="date" placeholder="" />                         
                                  @if ($errors->has('dob'))
                                  <div class="text-danger">{{ $errors->first('dob') }}</div>
                                @endif
                                     </div> 
                                     </div> --}}
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Date of Birth</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text"  name="dob"  value ="{{old('dob')}}" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="DD/MM/YYYY"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                      
                                    </div>
                                    @if ($errors->has('dob'))
                                    <div class="text-danger">{{ $errors->first('dob') }}</div>
                                  @endif
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="Standerd">Standerd <span class="input-mandatory">*</span></label>
                                  <select name="standname" id="dg-standname-select" class="form-control adi-select2">
                                    <option value="">Select One</option>
                                    @foreach ($stander as $key)
                                    <option value="{{$key->standerd}}"{{(old('standname') == $key->standerd)?'selected':''}} >{{$key->standerd}}</option>
                                    @endforeach
                                  </select>
                                  @if ($errors->has('standname'))
                                  <div class="text-danger">{{ $errors->first('standname') }}</div>
                                @endif
                                </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="subject">Division <span class="input-mandatory">*</span></label>
                                    <select name="subname" id="dg-subname-select" class="form-control adi-select2">
                                        <option value="">Select One</option>
                                    </select>
                                    @if ($errors->has('subname'))
                                    <div class="text-danger">{{ $errors->first('subname') }}</div>
                                  @endif
                                  </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{route('student.index')}}" class="btn btn-secondary">Cancel</a>
                                </form>
                                </div>
                                <!-- /.card-body -->

                                
                                </div>
                            
                            </div>
            <!-- /.card -->

            <!-- general form elements -->
          
            <!-- /.card -->

            <!-- Input addon -->
            
            <!-- /.card -->
            <!-- Horizontal Form -->
            
            <!-- /.card -->

          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script>
    $(document).ready(function () {         
      var name = $("#dg-standname-select").val();
        $.ajax({
             method: "get",
             url: '{{route("student.get")}}',
             data: {name:name},
             success: function (data) {
              $("#dg-subname-select").html(data).trigger('change');
             
             },
             });
            })
  </script>
  <script>
    $("#dg-standname-select").change(function(){
        var name = $(this).val();
        $.ajax({
             method: "get",
             url: '{{route("student.get")}}',
             data: {name:name},
             success: function (data) {
              $("#dg-subname-select").html(data).trigger('change');
             },
          });
      });
  </script>

  @endsection