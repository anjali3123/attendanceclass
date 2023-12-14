<?php

namespace App\Http\Controllers;

use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Standerd;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function button(){
      $stander =Standerd::get();
      return view('student.button',compact('stander'));
    }
    public function index()
    {
      $uicongfig = [
        'title' => "Student",
        'header' => "Student",
        'active' => "student",
    ];
        return view('student.index',compact('uicongfig'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stander =Standerd::get();
        return view('student.add',compact('stander'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $roll = Student::max('roll_no');
      // echo"<pre>";print_r($roll);exit;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|max:50|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/i',
            'dob' => 'required',
            'contactno' => 'required|numeric|digits:10',
            'standname' => 'required',
            'subname' => 'required',

        ],[
            'name.required' => 'The name field is required.',
            'contactno.digits' => 'The phone no must be 10 digits.',
            'dob.required' => 'The date of birth field is required.',
            'contactno.numeric' => 'The phone no must be a number.',
            'contactno.required' => 'The phone no field is required.',
            'standname.required' => 'The standerd field is required.',
            'subname.required' => 'The subject field is required.',

        ]);
        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }

          $student = new Student();
          $student->name = $request->name;
          $student->email = $request->email;
          $student->dob = $request->dob;
          $student->roll_no = $roll + 1;
          $student->contactno = $request->contactno;
          $student->standname = $request->standname;
          $student->subname = $request->subname;
        //   echo"<pre>";print_r($student->toArray());exit;
          if($student->save()){
            return redirect()->route('student.index')->with('success','student has been created successfully.');
        }else{
            return redirect()->route('subject.index')->with('danger','student failed to create.');
        }

    }
    public function geta(Request $request)
    {
       $id = DB::table('standerds')->where('standerd',$request->name)->first();
      //  echo"<pre>";print_r($id);exit;
      $r ='A';
      // $r = 64;
       $h = '<option value="">Select One</option>';
       if ($id) {
          $st = DB::table('standerds')->where('standerd',$id->id)->first();

          for($i=0;$i<$st->div_id;$i++){
            $h .= '<option value="'.$r.'">'.$r.'</option>';
            $r++;
          }
       }

       echo $h;

    }
    public function get(Request $request)
    {
       $id = DB::table('standerds')->where('standerd',$request->name)->first();
      //  echo"<pre>";print_r($id);exit;
      // $r = range('A', 'ZZ');
       $h = '<option value="">Select One</option>';
       if ($id) {
           $st = DB::table('standerds')->where('standerd',$id->id)->first();
           $test = self::createLetterRange($st->div_id);
          //  $test = $this->createLetterRange($st->div_id);
           //  echo "<pre>";print_r($test);echo "</pre>";exit;
           foreach($test as $key => $value){
             $h .= '<option value="'.$value.'">'.$value.'</option>';
           }
       }

       echo $h;

    }


   public static function createLetterRange($length)
{
    $range = array();
    $letters = range('A', 'Z');
    for($i=0; $i<$length; $i++)
    {
        $position = $i*26;
        foreach($letters as $ii => $letter)
        {
            $position++;
            if($position <= $length)
                $range[] = ($position > 26 ? $range[$i-1] : '').$letter;
        }
    }
    return $range;
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
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

          $list = Student::get();
          return datatables($list)
            ->addIndexColumn()

            ->addColumn('dob',function($row){
                return !empty($row->dob)?($row->dob):'';
                })
            ->addColumn('action', function ($row) {


              return '<a href="'.route('student.edit',($row->id)).'" class="btn btn-outline-info btn-sm mr-p5"><i class="fa fa-edit" aria-hidden="true"></i></a>
              <button type="button" onclick="departdeleted(' . ($row->id) . ')"class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt" aria-hidden="true"></i></button>';
            })
            ->rawColumns(['action', 'standerdid'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $stander =Standerd::get();
      $student = Student::find($id);


      return view('student.edit',compact('student','stander'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'dob' => 'required',
            'standname' => 'required',
            'standname' => 'required',
            'contactno' => 'required|numeric|digits:10',
            'subname' => 'required',
            'email' => 'required|max:50|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/i',

        ],[
            'name.required' => 'The name field is required.',
            'dob.required' => 'The date of birth field is required.',
            'contactno.required' => 'The phone no field is required.',
            'contactno.numeric' => 'The phone no must be a number.',
            'contactno.digits' => 'The phone no must be 10 digits.',
            'standname.required' => 'The standerd field is required.',
            'subname.required' => 'The subject field is required.',

        ]);
        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }
          $student = Student::where('id',$request->id)->first();
          $student->name = $request->name;
          $student->email = $request->email;
          $student->dob = $request->dob;
          $student->contactno = $request->contactno;
          $student->roll_no = $request->roll_no;
          $student->standname = $request->standname;
          $student->subname = $request->subname;
        //   echo"<pre>";print_r($student->toArray());exit;
          if($student->save()){
            return redirect()->route('student.index')->with('success','student has been updated successfully.');
        }else{
            return redirect()->route('subject.index')->with('danger','student failed to update.');
        }
    }


    public function import(Request $request){

      $validator = Validator::make($request->all(), [
        // 'fileno' => 'required',

        'file' => ['required','file',function ($attribute, $value, $fail) {
            $ext = pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION);
            if (!in_array(strtolower($ext),['csv','xlsx'])) {
                $fail('Only csv file supported.');
            }}],

    ],[


        'file.required' => 'The upload file field is required.',

    ]);
    if ($validator->fails()) {
        return response()->json(array(
            'error' => 1,
            'vderror' => 1,
            'errors' => $validator->getMessageBag()->toArray()
        ), 200);
    }
    $file = $request->file;
    // echo "<pre>"; print_r($file->getPathName()); exit;



    if(($handle = fopen($file->getPathName(), 'r')) !== FALSE)
    {
      // echo "<pre>"; print_r($data); echo "</pre>";
      $i = 0;
      while(($data = fgetcsv($handle, 1000, ',')) !== FALSE)
      {
        if ($i == 0) {
          $i++;
          continue;
        }

        // $all_data =  _r($data); echo "</pre>";

        $st = array(
          'name' => $data[0],
          'email' => $data[1],
          'dob' => $data[2],
          'contactno' => $data[3],


        );

        $validator = Validator::make($st, [
          'name' => 'required',
          'email' => 'required|max:50|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/i',
          'contactno' => 'required|numeric|digits_between:6,14',
          'dob' => 'required',
      ]);
      if ($validator->fails()) {
        return response()->json(array(
          'error' => 1,
          'msg' => "Student import file is invalid."
        ), 200);
      }
        $insert = DB::table('students')->insert($st);
      }


      if($insert){
        return response()->json(array(
            'error' => 0,
            'msg' => "Student has been imported successfully."
          ), 200);
        } else {
          return response()->json(array(
            'error' => 1,
            'msg' => "Student failed to import."
          ), 200);
        }

    }
  }



    public function downloadFile()
    {
        ob_clean();
        $filePath = public_path("/sample_files/student-import.csv");
        $headers = array('Content-Encoding: UTF-8','Content-Type: text/csv');
        $fileName = 'student-import_sample_file'.'.csv';
        return response()->download($filePath, $fileName, $headers);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if(Student::where(['id'=>$request->id])->delete())
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
