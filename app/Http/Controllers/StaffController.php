<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Psy\TabCompletion\Matcher\FunctionsMatcher;

class StaffController extends Controller
{
 public function index(Request $request){

  $uicongfig = [
    'title' => "Staff",
    'header' => "Staff",
    'active' => "staff",
];
    return view('staff.index',compact('uicongfig'));
 }
  public function add(){
    
    return view('staff.add');
  }

  public function create(Request $request)
  {  
      
      
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          // 'username' => 'required|unique:users',
          'username' => ['required','max:50',
          Rule::unique('users','username')->where(function ($query){
              return $query->where('isDeleted', 0);
          }),],
          'filename' => ['required','file',function ($attribute, $value, $fail) {
            $ext = pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION);
            if (!in_array(strtolower($ext),['csv'])) {
                $fail('Only csv file supported.');
            }}],
          'email' => 'required|max:50|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/i',
          
          'position' => 'required',
          'status' => 'required',
          'contactno' => 'required|numeric|digits_between:6,14|',
          'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*+_-]{8,}$/',
      ], [
     
      'password.regex' => 'The password  must be have at least 8 characters long 1 uppercase & 1 lowercase character 1 number. . ',
      'contactno.required' => 'The phone no field is required.',
      'contactno.numeric' => 'The phone no must be a number.',
      'contactno.digits_between' => 'The phone no must be between 6 and 14 digits.',
    ]);
    if ($validator->fails()) {
      return redirect()
      ->back()
      ->withErrors($validator)
      ->withInput();
  }
      // echo "<pre>"; print_r($request->all()); exit;
      $data = $request->all();
     
      
      // $ext = ($request->filename->getClientOriginalName());
      
      $fileName = time().'.'.$request->filename->getClientOriginalName();
      // echo "<pre>"; print_r($fileName); exit;
      // $filename =$request->id.rand(1000,9999).'t'.time().'.'.$ext;
      move_uploaded_file($request->filename->getPathName(),public_path('uploads/fileupload/'.$fileName));


      $user = new User();
      $user->name = $request->name;
      $user->username = $request->username;
      $user->filename =  $fileName;
      $user->email = $request->email;
      $user->position = $request->position;
      $user->contactno = $request->contactno;
      $user->status = $request->status;
      $user->password = Hash::make($request->password);
      // echo"<pre>";print_r($user->toArray());exit;
      // $user->save();
      if ($user->save()) {

        return redirect()->route('staff.index')->with('success','Staff has been created successfully.');
      }else{
          return redirect()->route('staff.index')->with('danger','Staff failed to create.');
      }
      
      }

      public function list(Request $request)
  {
    if (!$request->ajax()) {
      return response()->json([
        "status" => "fail",
        "message" => "Bad Request."
      ], 401);
    }

    $list = User::where('isDeleted',0)->get();
    return datatables($list)
      ->addIndexColumn()
      ->addColumn('position', function ($row) {
        return $row->position == 1?'Principal':'Teachers'; 
      })
      ->addColumn('status', function ($row) {
        if ($row->status) {
          
          return '<button type="button" class="btn btn-block btn-danger btn-sm" onclick="changestatus('.($row->id).')">Disable</button>';
        } else {
          return '<button type="button" class="btn btn-block btn-success btn-sm" onclick="changestatus('.($row->id).')">Enable</button>';
        }
      })
      ->addColumn('action', function ($row) {
        // $btn ='';
        // $btn .='<button type="button" onclick="edit(' . ($row->id) . ')" class="btn btn-outline-info btn-sm mr-p5"><i class="far fa-edit" aria-hidden="true"></i></button>';
        // if(Takebook::where(['bookid'=> $row->id])->count() == 0){
        //   $btn .=' <button type="button" onclick="departdeleted(' . ($row->id) . ')" class="btn btn-outline-danger btn-sm" mr-p5><i class="far fa-trash-alt" aria-hidden="true"></i></button>';
        // }
        // $btn .=' <button type="button" onclick="stock(' . ($row->id) . ')" class="btn btn-outline-purple btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></button>';
        
        return '<a href="'.route('staff.get',($row->id)).'" class="btn btn-outline-info btn-sm mr-p5"><i class="fa fa-edit" aria-hidden="true"></i></a>
        <button type="button" onclick="departdeleted(' . ($row->id) . ')" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt" aria-hidden="true"></i></button>';
      })
      ->rawColumns(['action', 'status'])
      ->make(true);
  }
  public function get($id){
    $user = User::find($id);
    return view('staff.edit',compact('user'));
  }

   public function update(Request $request)
  {
//     $validator = Validator::make($request->all(), [
//       'name' => 'required',
//       'username' => 'required',
//       'email' => 'required|max:50|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/i',
//       'position' => 'required',
//       'status' => 'required',
//       'contactno' => 'required|numeric|digits_between:6,14',
//       'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*+_-]{8,}$/',
//   ], [
 
//   'password.regex' => 'The password  must be have at least 8 characters long 1 uppercase & 1 lowercase character 1 number. . ',
//   'contactno.required' => 'The phone no field is required.',
//   'contactno.numeric' => 'The phone no must be a number.',
//   'contactno.digits_between' => 'The phone no must be between 6 and 14 digits.',
// ]);
// if ($validator->fails()) {
//   return redirect()
//   ->back()
//   ->withErrors($validator)
//   ->withInput();
// }

  $user = User::where('id',$request->id)->first();
  $user->name = $request->name;
  $user->username = $request->username;
  $user->email = $request->email;
  $user->position = $request->position;
  $user->contactno = $request->contactno;
  $user->status = $request->status;
  $user->password = Hash::make($request->password);
  
  // $user->save();
  if ($user->save()) {

    return redirect()->route('staff.index')->with('success','Staff has been Upadated successfully.');
  }else{
      return redirect()->route('staff.index')->with('danger','Staff failed to upadte.');
  }
  }

  public  function status(Request $request)
  {
    $user = User::where('id',$request->id)->first();
    if ($user) {
      if ($user->status) {
        $user->status = 0;
      } else {
        $user->status = 1;
      }
      $user->save();
      return response()->json(array(
        'error' => 0,
        'msg' => "Staff status has been changed successfully."
      ), 200);
    } else {
      return response()->json(array(
        'error' => 1,
        'msg' => "Staff status failed to change."
      ), 200);
    }
  }


  public function delete(Request $request){

    // $user = User::where('id',$request->id)->first();
    if(User::softDelete(['id'=>$request->id]))
    {
      return response()->json(array(
        'error' => 0,
        'msg' => "Staff has been deleted successfully."
      ), 200);
    } else {
      return response()->json(array(
        'error' => 1,
        'msg' => "Staff failed to update."
      ), 200);
    }

  }
}
