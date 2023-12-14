<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Standerd;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $uicongfig = [
        'title' => "Division",
        'header' => "Division",
        'active' => "division",
    ];
        $standerd = Standerd::get();
        return view('division.index',compact('standerd','uicongfig'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $division =Division::where('id',$request->id)->first();
      $standerdid = Standerd::get();
        $validator = Validator::make($request->all(), [
            // 'divison' => 'required',

            'divison' => ['required','max:50',
            Rule::unique('divisions','divison')->where(function ($query){
                return $query->where('isDeleted', 0);
            }),],
            ],[
            'divison.required' => 'The divison field is required.',
            // 'standerdid.required' => 'The standerd field is required.',

        ]);
        if ($validator->fails()) {
            return response()->json(array(
              'error' => 1,
              'vderror' => 1,
              'errors' => $validator->getMessageBag()->toArray(),
            ), 200);
          }

          $division = new Division();
          $division->divison = $request->divison;
          // $division->standerdid = $request->standerdid;
          if($division->save()){
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
      
          $list = Division::where('isDeleted',0)->get();
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
            'divison' => 'required',
            // 'standerdid' => 'required',
         
        ],[
            'divison.required' => 'The divison field is required.',
            // 'standerdid.required' => 'The standerd field is required.',

        ]);
        if ($validator->fails()) {
            return response()->json(array(
              'error' => 1,
              'vderror' => 1,
              'errors' => $validator->getMessageBag()->toArray(),
            ), 200);
          }

          $division =Division::where('id',$request->id)->first();
          $division->divison = $request->divison;
          // $division->standerdid = $request->standerdid;
          if($division->save()){
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\division  $division
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Division::where('id',$request->id)->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\division  $division
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
      // $division = Division::where('id',$request->id)->first();
      if(Division::softDelete(['id'=>$request->id]))
      {
        return response()->json(array(
          'error' => 0,
          'msg' => "Division has been deleted successfully."
        ), 200);
      } else {
        return response()->json(array(
          'error' => 1,
          'msg' => "Division failed to update."
        ), 200);
      }
    }
}
