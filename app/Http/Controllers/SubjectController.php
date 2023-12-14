<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Standerd;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $uicongfig = [
        'title' => "Subject",
        'header' => "Subject",
        'active' => "subject",
    ];
        $standerd = Standerd::get();
        return view('subject.index',compact('standerd','uicongfig'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'subjectname' => 'required|unique:subjects',

            'subjectname' => ['required','max:50',
            Rule::unique('subjects','subjectname')->where(function ($query){
                return $query->where('isDeleted', 0);
            }),],
           
            // 'standerdid' => 'required',
         
        ],[
            'subjectname.required' => 'The subject name field is required.',
            'subjectname.unique' => 'The subject name has already been taken.'
            // 'standerdid.required' => 'The standerd field is required.',

        ]);
        if ($validator->fails()) {
            return response()->json(array(
              'error' => 1,
              'vderror' => 1,
              'errors' => $validator->getMessageBag()->toArray(),
            ), 200);
          }

          $subject = new Subject();
          $subject->subjectname = $request->subjectname;
          // $subject->standerdid = $request->standerdid;
          if($subject->save()){
            return response()->json(array(
                'error' => 0,
                'msg' => "subject has been created successfully."
              ), 200);
            } else {
              return response()->json(array(
                'error' => 1,
                'msg' => "subject failed to create."
              ), 200);
            }
          
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\division  $division
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
      
          $list = Subject::where('isDeleted',0)->get();
          return datatables($list)
            ->addIndexColumn()
            // ->addColumn('standerdid', function ($row) {
            //   return $row->standerd->standerd ; 
            // })
            
            ->addColumn('action', function ($row) {
              
              
              return '<button type="button"  onclick="edit(' . ($row->id) . ')" class="btn btn-outline-info btn-sm mr-p5"><i class="fa fa-edit" aria-hidden="true"></i></button>
              <button type="button" onclick="departdeleted(' . ($row->id) . ')"class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt" aria-hidden="true"></i></button>';
            })
            ->rawColumns(['action', 'standerdid'])
            ->make(true); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subjectname' => 'required',
            // 'standerdid' => 'required',
         
        ],[
            'subjectname.required' => 'The subject name field is required.',
            // 'standerdid.required' => 'The standerd field is required.',

        ]);
        if ($validator->fails()) {
            return response()->json(array(
              'error' => 1,
              'vderror' => 1,
              'errors' => $validator->getMessageBag()->toArray(),
            ), 200);
          }

          $subject =Subject::where('id',$request->id)->first();
          $subject->subjectname = $request->subjectname;
          // $subject->standerdid = $request->standerdid;
          if($subject->save()){
            return response()->json(array(
                'error' => 0,
                'msg' => "Subject has been created successfully."
              ), 200);
            } else {
              return response()->json(array(
                'error' => 1,
                'msg' => "Subject failed to create."
              ), 200);
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\division  $division
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Subject::where('id',$request->id)->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\division  $division
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
    //   $subject = Subject::where('id',$request->id)->first();
      if(Subject::softDelete(['id'=>$request->id]))
      {
        return response()->json(array(
          'error' => 0,
          'msg' => "Subject has been deleted successfully."
        ), 200);
      } else {
        return response()->json(array(
          'error' => 1,
          'msg' => "Subject failed to update."
        ), 200);
      }
    }
}
