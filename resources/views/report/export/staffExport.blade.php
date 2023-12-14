<table id="student-details-list" class="table table-bordered table-hover">
    <thead>
      <tr>                          
        <th>Created at</th>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Position</th>
        <th>Contact No.</th>
        <th>Status</th>                                            
      </tr>                                             
  </thead>
  <tbody>
    @foreach ($staff as $lists)
    <tr>  
        <td>{{date('d-m-Y',strtotime($lists->created_at)) }}</td>        
        <td>{{$lists->name}}</td>
        <td>{{ $lists->username}}</td> 
        <td>{{ $lists->email}}</td>
        <td>{{ ($lists->position == 1)?'Principal':'Teacher'}}</td>
        <td>{{ $lists->contactno}}</td>
        <td>{{( ($lists->status == 0)?'Enable':'Disable')}}</td>                           
        {{-- <td>{{( empty($lists->divison->divison)?'':$lists->divison->divison)}}</td>                            --}}
                                                             
    </tr>
   @endforeach   
  </tbody>