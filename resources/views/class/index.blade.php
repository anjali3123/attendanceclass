@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Class Room</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item">Class Room</li>
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
              {{-- <h3 class="card-title">Staff selection </h3> --}}
              {{-- <button type="button" class="btn btn-info  m-l-15 text-white" data-bs-toggle="modal" data-bs-target="#add-division-modal" data-whatever="@mdo"><i class="fa fa-plus-circle"></i> Create New</button> --}}
              {{-- <a href="#" class="btn btn-info  m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</a> --}}
            {{-- </div> --}}
            <!-- /.card-header -->
            <div class="card-body p-3">
              <table class="table table-striped" id="classroom-details-list">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Standerd</th>
                    <th>Division</th>
                    {{-- <th>Action</th> --}}
                  </tr>
                </thead>
                <tbody> 
                @php $k=0; @endphp
                  @foreach($std as $stdv)
                   @php
                       $r ='A';
                   @endphp

                  @for($i=0;$i<$stdv->div_id;$i++)
                  <tr>
                    <td>{{++$k}}</td>
                    <td>{{$stdv->standerd}}</td>
                    <td>{{$r}}</td>
                    @php $r++; @endphp
                    {{-- <td><a href="#" class="btn btn-outline-info btn-sm mr-p5"><i class="far fa-calendar-alt" aria-hidden="true"></i></a></td> --}}
                  </tr>
                  @endfor
                  @endforeach     
                </tbody>
              </table>
              {!! $std->links() !!}
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


@endsection