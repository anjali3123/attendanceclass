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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class DayCantroller extends Controller
{
public function index(Request $request){
    $uicongfig = [
        'active' => "Day",
    ];
    $day = Day::get();

    return view('day.index',compact('day','uicongfig'));
}

public function add (Request $request){
    $id = $request->id;
    $day = Day::where('id',$id)->first();
    // $st = [];
//    $table= Timetable::where(['day_id'=>$id])->get();
//     $time = Timetable::get();
   $std = Standerd::get();

   if (Timetable::where(['day_id'=>$id])->count() == 0) {
//    if( $id != 0){
    foreach($std as $key){
    for ($i=1; $i <=4 ; $i++) {
        DB::table('timetables')->insert(['day_id'=>$id,'std_id'=>$key->id,'slot' => $i]);
    }
}
        return redirect()->route('timetable.index',['id'=>$id])->with('success','Time table has been Created successfully.');

     }else{

        return redirect()->route('timetable.index',['id'=>$id]);


    }


    }


public function list(Request $request){
    $list = Day::get();

    return datatables($list)
              ->addIndexColumn()


              ->addColumn('action', function ($row) {


                // return '<a href="'.route('standerd.create',($row->id)).'" class="btn btn-outline-info btn-sm mr-p5"><i class="fa fa-book" aria-hidden="true"></i></a>
                // <a href="'.route('standerd.get',($row->id)).'" class="btn btn-outline-info btn-sm mr-p5"><i class="fas fa-columns" aria-hidden="true"></i></a>';

                return '<a href="'.route('day.add',['id' => $row->id]).'" class="btn btn-outline-info btn-sm mr-p5"><i class="far fa-calendar-alt" aria-hidden="true"></i></a>
               ';
              })
              ->rawColumns(['action', 'standerdid'])
              ->make(true);
}

}
