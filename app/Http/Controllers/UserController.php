<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class UserController extends Controller
{

public function profile(Request $request)
{
    $user = Auth::user();
    return view('user.profile',compact('user'));
}

 public function update(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|max:50|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/i',
        'contactno' => 'numeric|digits_between:6,14',
     
    ], [
    'name'=> 'The name field is required.',
    'email.regex' => 'The email must be a valid email address.',
    'contactno.numeric' => 'The phone no must be a number.',
    'contactno.digits_between' => 'The phone no must be between 6 and 14 digits.',
  ]);
if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }
  $user = User::find(Auth::user()->id);
    // echo"<pre>";print_r($user);exit;
  $user->name = $request->name;
  $user->email = $request->email;
  $user->contactno = $request->contactno;

  if($user->save()){
    return redirect('dashboard')->with('showalert',['success','Profile has been updated successfully.']);
}else{
    return redirect('dashboard')->with('showalert',['danger','Profile failed to update']);
}
}
public function passwordchange(Request $request)
{
    return view('user.changepassword');
}
public function passwordupdate(Request $request){

    $validator = Validator::make($request->all(), [
        'current_password' => ['required',function($attrtibute, $value , $fail){
            if (!(Hash::check($value, Auth::user()->password))) {
                $fail('Current password is wrong.');
            }
        }],
        'new_password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*+_-]{8,}$/',
        'confirm_new_password' => 'required|same:new_password',
    ]);
    if ($validator->fails()) {
        return redirect()
        ->back()
        ->withErrors($validator)
        ->withInput();
    }

    $user = User::find(Auth::user()->id);
    $user->password =Hash::make($request->new_password);
   if($user->save()){
    Auth::logout();
            return redirect()->route('login')->with('showalert',['success','Password has been updated successfully.']);
        }else{
            return redirect()->route('user.changepassword')->with('showalert',['danger','Password failed to update.']);
        }
}
}