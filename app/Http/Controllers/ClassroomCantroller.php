<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Division;
use Illuminate\Http\Request;
use  App\Models\Standerd;
use App\Models\StanderdDivision;
use App\Models\Subject;
use App\Models\SubjectStanderd;
use Illuminate\Support\Facades\DB;

class ClassroomCantroller extends Controller
{

public function index(Request $request){
    $uicongfig = [
        'active' => "class",
    ];
    $std = DB::table('standerds')->paginate(5);
  
    // foreach($std as $stds){
    //     $r ='A';
    //     for($i=0;$i<$stds->div_id;$i++){
    //         print $stds->standerd.'-'.$r."<br>";
    //         $r++;
    //     }
       
    // }
    // echo"<pre>";print_r($h);exit;
   return view('class.index',compact('uicongfig','std'));
}

}
















