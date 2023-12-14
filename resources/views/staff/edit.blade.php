@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Staff</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('staff.index')}}">Staff selection</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
                    <form action="{{route('staff.update')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="name" name="name" value="{{old('name',$user->name)}}" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                                  @if ($errors->has('name'))
                                  <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="username">Username</label>
                                  <input type="username" name="username" value="{{old('username',$user->username)}}" class="form-control" id="username" placeholder="Enter username">
                                  @if ($errors->has('username'))
                                  <div class="text-danger">{{ $errors->first('username') }}</div>
                                @endif
                                </div>
                              </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" value="{{old('email',$user->email)}}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                  @endif
                                </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contactno">Contactno</label>
                                        <input type="text" name="contactno" value="{{old('contactno',$user->contactno)}}" class="form-control" id="exampleInputPassword1" placeholder="Enter contactno">
                                        @if ($errors->has('contactno'))
                                        <div class="text-danger">{{ $errors->first('contactno') }}</div>
                                      @endif
                                    </div>
                                    </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <label>Select</label>
                                        <select class="form-control" name="position">
                                          <option value="">Select Position</option>
                                          <option value="1" {{(old('position',$user->position) == '1')?'selected':''}}>Principal</option>
                                          <option value="2" {{(old('position',$user->position) == '2')?'selected':''}}>Teachers</option>
                                          @if ($errors->has('position'))
                                          <div class="text-danger">{{ $errors->first('position') }}</div>
                                        @endif
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="position">Status</label>
                                            <label>Select</label>
                                            <select class="form-control" name="status">
                                              <option value="0" {{(old('status',$user->status) == '0')?'selected':''}}>Enable</option>
                                              <option value="1" {{(old('status',$user->status) == '1')?'selected':''}} >Disable</option>
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{route('staff.index')}}" class="btn btn-secondary">Cancel</a>
                                </form>
                                </div>
                                <!-- /.card-body -->

                                
                                </div>
                            
                            </div>
        </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection