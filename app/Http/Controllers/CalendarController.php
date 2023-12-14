<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Division;
use Illuminate\Http\Request;
use  App\Models\Standerd;
use App\Models\StanderdDivision;
use App\Models\Subject;
use App\Models\SubjectStanderd;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
 public function index(Request $request){
   
      $uicongfig = [
        'title' => "Calendar",
        'header' => "Calendar",
        'active' => "calendar",
    ];
    // $day = Day::where('dayname',date('l',strtotime($request->date)))->first();
    $time = Timetable::get();
     return view("calendar.index",compact('time','uicongfig'));
   

    
 }
 public function show(Request $request){

 
   $day = Day::where('dayname',date('l',strtotime($request->date)))->first();
   //    echo"<pre>";print($day);exit;
       $dashcount = Timetable::where('teacher_id',Auth::user()->id)->where('day_id',$day->id)->orderBy('slot')->get();
       return view("calendar.timetable",compact('day','dashcount'));
        
}

public function add(Request $request){
  
  // $date = Day::where('dayname',date('l',strtotime($request->date)))->get();
  $date = (date('l',strtotime($request->date)));
  // echo"<pre>";print($day);exit;
  if($date != "Sunday")
  {
    return response()->json(array(
      'error' => 0,
      'msg' => ""
    ), 200);
  }else{
    return response()->json(array(
      'error' => 1,
      'msg' => ""
    ), 200);
  }
}
}