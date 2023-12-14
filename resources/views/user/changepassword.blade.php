@extends('layouts.main')

@section('content')

<!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="content-wrapper">
          <!-- ============================================================== -->
          <!-- Container fluid  -->
          <!-- ============================================================== -->
          <div class="container-fluid">
              <!-- ============================================================== -->
              <!-- Bread crumb and right sidebar toggle -->
              <!-- ============================================================== -->
              <section class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1>Change Password</h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                      </ol>
                    </div>
                  </div>
                </div><!-- /.container-fluid -->
              </section>
              <!-- ============================================================== -->
              <!-- End Bread crumb and right sidebar toggle -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Start Page Content -->
              <!-- ============================================================== -->
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h5 class="card-title">User Change Password Details</h5>
                        </div>
                          <div class="card-body">
                              <form class="form-control-line" action="{{route('user.passwordupdate')}}" method="post">
                                @csrf
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group ">
                                      <label class="form-control-label">Current Password <span class="input-mandatory">*</span></label>
                                      <div class="with-icon">
                                        <input type="password" name="current_password" id="inp-user-current_password" placeholder="Current Password" class="form-control">
                                       
                                      </div>
                                      @if ($errors->has('current_password'))
                                        <div class="text-danger">{{ $errors->first('current_password') }}</div>
                                      @endif
                                  </div> 
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group ">
                                      <label class="form-control-label">New Password <span class="input-mandatory">*</span></label>
                                      <div class="with-icon">
                                        <input type="password" name="new_password" id="inp-user-new_password" placeholder="New Password" class="form-control">
                                        
                                      </div>
                                      @if ($errors->has('new_password'))
                                        <div class="text-danger">{{ $errors->first('new_password') }}</div>
                                      @endif
                                  </div> 
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="form-control-label">Confirm New Password <span class="input-mandatory">*</span></label>
                                      <div class="with-icon">
                                        <input type="password" name="confirm_new_password" id="inp-user-confirm_new_password" placeholder="Confirm New Password" class="form-control">
                                       
                                      </div>
                                      @if ($errors->has('confirm_new_password'))
                                        <div class="text-danger">{{ $errors->first('confirm_new_password') }}</div>
                                      @endif
                                  </div> 
                                  </div>
                                </div>
                                <hr>
                            
                                <button type="submit" class="btn btn-info text-white">Save</button>
                                <a href="{{route('dashboard')}}" class="btn btn-secondary">Cancel</a>
                            </form>

                          </div>
                      </div>
                  </div>
              </div>

             
              <!-- /.row -->
              <!-- ============================================================== -->
              <!-- End PAge Content -->
              <!-- ============================================================== -->
          </div>
          <!-- ============================================================== -->
          <!-- End Container fluid  -->
          <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
@endsection