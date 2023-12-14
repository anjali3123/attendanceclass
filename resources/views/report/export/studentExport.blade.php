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

<!-- /.card-body -->
        
</table>