<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Http\Request;
use  App\Models\Standerd;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
   
    public function dashboard()
    {
        $uicongfig = [
            'title' => "Dashboard",
            'header' => "Dashboard",
            'active' => "dashboard",
        ];
        
       $day = Day::where('dayname',date('l'))->first();
    //    echo"<pre>";print($day);exit;
        $dashcount = Timetable::where('teacher_id',Auth::user()->id)->where('day_id',$day->id)->orderBy('slot')->get();
        // echo"<pre>";print($dashcount);exit;
        return view('dashboard.home',compact('uicongfig','dashcount'));
    }
    
     public function get(Request $request)
    {
       
        $count['users'] = User::where(['isDeleted'=>0])->count();
        $count['enabled_users'] = User::where(['isDeleted'=>0,'status'=>0])->count();
        $count['standers'] =Standerd::count();
        $count['subjects'] =Subject::count();
        $count['teacher'] =User::where(['position'=>2,'isDeleted'=>0])->count();
        // echo"<pre>";print_r($count['teacher']);exit;
        return $count;
    }
}
