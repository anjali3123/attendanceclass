<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use  App\Models\Standerd;
use App\Models\StanderdDivision;
use App\Models\Subject;
use App\Models\SubjectStanderd;
use Illuminate\Support\Facades\DB;

class StanderdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uicongfig = [
            // 'title' => "Standerd",
            // 'header' => "Standerd",
            'active' => "standerd",
        ];
        $standerd = Standerd::get();
       return view('standerd.index',compact('uicongfig')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $std = Standerd::find($id);
      
        $subject = Subject::get();
        $subjectStanderd = SubjectStanderd::where('std_id',$id)->get();
        $sd = [];
        foreach($subjectStanderd as $ds){
            $sd[] = $ds->sub_id;
        }
        return view('standerd.subject',compact('subject','std','id','sd'));
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store($id,Request $request)
    {
        // echo "<pre>"; print_r($request->all()); exit;
        $standerd =$id;
       
        $request->sub_id = empty($request->sub_id)?[]:$request->sub_id;
       
        SubjectStanderd::where('std_id',$standerd)->whereNotIn('sub_id',$request->sub_id)->delete();
     
        foreach($request->sub_id as $sid){
           
            $subject = SubjectStanderd::where(['std_id'=>$standerd,'sub_id'=>$sid])->first();
      

            if (empty($subject)) {
            DB::table('subject_standerds')->insert([
                'std_id' => $standerd, 'sub_id' => $sid
            ]);
            }
        }
        return redirect()->route('standerd.index')->with('success','Subject has been Add successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\standerd  $standerd
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                "status" => "fail",
                "message" => "Bad Request."
              ], 401);
            }
        
            $list = Standerd::get();
            return datatables($list)
              ->addIndexColumn()
              
              
              ->addColumn('action', function ($row) {
                
                
                // return '<a href="'.route('standerd.create',($row->id)).'" class="btn btn-outline-info btn-sm mr-p5"><i class="fa fa-book" aria-hidden="true"></i></a>
                // <a href="'.route('standerd.get',($row->id)).'" class="btn btn-outline-info btn-sm mr-p5"><i class="fas fa-columns" aria-hidden="true"></i></a>';

                return '<a href="'.route('standerd.create',($row->id)).'" class="btn btn-outline-info btn-sm mr-p5"><i class="fa fa-book" aria-hidden="true"></i></a>
                <button type="button" onclick="get(' . ($row->id) . ')"class="btn btn-outline btn-sm mr-p5" style="color:#626aa7;"><i class="fas fa-columns" aria-hidden="true"></i></button>';
              })   
              ->rawColumns(['action', 'standerdid'])
              ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\standerd  $standerd
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $std = Standerd::find($id);
      
        $division = Division::get();
        $standerdDiv =StanderdDivision::where('std_id',$id)->get();
        $sd = [];
        foreach($standerdDiv as $ds){
            $sd[] = $ds->div_id;
        }
        return view('standerd.division',compact('division','std','id','sd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\standerd  $standerd
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $standerd =$id;
       
        $request->div_id = empty($request->div_id)?[]:$request->div_id;
       
        StanderdDivision::where('std_id',$standerd)->whereNotIn('div_id',$request->div_id)->delete();
     
        foreach($request->div_id as $sid){
           
            $division = StanderdDivision::where(['std_id'=>$standerd,'div_id'=>$sid])->first();
      

            if (empty($division)) {
            DB::table('standerd_divisions')->insert([
                'std_id' => $standerd, 'div_id' => $sid
            ]);
            }
        }
        return redirect()->route('standerd.index')->with('success','Division has been Add successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\standerd  $standerd
     * @return \Illuminate\Http\Response
     */
    public function getdiv(Request $request){
        $std = Standerd::where('id',$request->id)->first();
        return $std;
    }


    public function add(Request $request){

        $standerd = Standerd::where('id',$request->id)->first();
        $standerd->standerd = $request->standerd;
        $standerd->div_id = $request->div_id;
        if($standerd->save()){
            return response()->json(array(
                'error' => 0,
                'msg' => "Division has been created successfully."
              ), 200);
            } else {
              return response()->json(array(
                'error' => 1,
                'msg' => "Division failed to create."
              ), 200);
            }

    }
}
