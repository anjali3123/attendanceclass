<?php

namespace App\Http\Controllers;

use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Standerd;
use App\Models\Day;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\MockObject\Builder\Stub;

class TimetableController extends Controller
{
    public function index(Request $request){
        $uicongfig = [
            'active' => "Time",
        ];
    $stds = Standerd::get();
    $sub = Subject::get();
    $tech = User::where(['isDeleted' => 0,'position' => 2])->get();
        // echo"<pre>";print_r($tech);exit;
    $day = Day::get();
      //  echo"<pre>";print_r($day->toArray());exit;
    $id = $request->id;
    if(empty($id)){
        $time = Timetable::orderBy('sub_id')->get();
    }else{
      $time = Timetable::where('day_id',$id)->orderBy('sub_id')->get();
    
    }
        $st=[];
    
        // dynamic Array
        // foreach($time as $key){
        //     if($key->slot == 1){
        //     $st[1][] = $key;
        //     }elseif($key->slot == 2){
        //         $st[2][] = $key;
        //     }elseif($key->slot == 3){
        //         $st[3][] = $key;
        //     }elseif($key->slot == 4){
        //         $st[4][] = $key;
        //     }
        // }
        // dynamic Array
        foreach($time as $key){
            $st[$key->slot][] = $key;
        }

       return view('timetable.index',compact('uicongfig','time','stds','st','tech','day','sub'));
    }
     public function get(Request $request){
        $time = Timetable::where('id',$request->id)->first();
        return $time; 
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'sub_id' => 'required',
            'teacher_id' => ['required',
            Rule::unique('timetables','teacher_id')->where(function ($query) use($request){
                $time = Timetable::where('id',$request->id)->first();
                return $query->where('day_id', $time->day_id)->where('slot',$time->slot);
            })->ignore($request->id,'id'),],
           
            
        ], [
       
        
        'sub_id.required' => 'The subject field is required.',
        'teacher_id.required' => 'The teacher field is required.',
        'teacher_id.unique' =>'The teacher has already been assign.',
      ]);
      if ($validator->fails()) {
        return response()->json(array(
          'error' => 1,
          'vderror' => 1,
          'errors' => $validator->getMessageBag()->toArray(),
        ), 200);
      }
    $time = Timetable::where('id',$request->id)->first();
    $time->sub_id = $request->sub_id;
    $time->teacher_id = $request->teacher_id;
    if($time->save())
    {
        return response()->json(array(
          'error' => 0,
          'msg' => "Subject  and Teacher has been assign successfully."
        ), 200);
      } else {
        return response()->json(array(
          'error' => 1,
          'msg' => "Subject  and Teacher failed to assign."
        ), 200);
      }

    }
    public function day(Request $request)
    {
     $day = Timetable::where('day_id',$request->id)->first();
   
     return $day;
    }

}