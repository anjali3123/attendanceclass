@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stubjects</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('standerd.index')}}">Standerd selection</a></li>
              
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
            <div class="card-body">
              <form action="{{route('standerd.update',['id'=>$id])}}" method="post">
                @csrf 
                {{-- <input type="hidden" name="id" value=""> --}}
                 @foreach($division as $key)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="div_id[]" type="checkbox" value="{{$key->id}}" {{in_array($key->id,$sd)?'checked':''}}>
                        <label class="form-check-label">{{$key->divison}}
                        </label>
                      </div>
                        @endforeach
                  </div>     
                   <div class="card-footer">
                   <button type="submit" class="btn btn-primary">Submit</button>
                     <a href="{{route('standerd.index')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>               
                   
        </div>
      </div>
        </div>
        <!-- /.row -->
    </div>
    </section>
    <!-- /.content -->
  </div>



  @endsection