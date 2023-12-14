<?php

namespace App\Http\Controllers;

use App\Models\ExportReport;
use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Standerd;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\Builder\Stub;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    public function  student(Request $request)
    {


        $stander = Standerd::get();
        $requ = $request->all();
        $filter = [];
        if (!empty($request->standname)) {
            $filter['standname'] = $request->standname;
        }
        $student = Student::where($filter)->where(function ($q) use ($requ) {
            if (!empty($requ['from_date'])) {
                $q->where('created_at', '>=', ($requ['from_date']) . ' 00:00:00');
            }
            if (!empty($requ['to_date'])) {
                $q->where('created_at', '<=', ($requ['to_date']) . ' 23:59:59');
            }
        })->paginate(10);
        $student->appends($requ)->links();

        return view('report.student', compact('student', 'stander', 'requ'));
    }
    public function export(Request $request)
    {
        // $branches = AppointmentSlot::get();
        $stander = Standerd::get();
        $requ = $request->all();
        $filter = [];
        if (!empty($request->standname)) {
            $filter['standname'] = $request->standname;
        }
        $student = Student::where($filter)->where(function ($q) use ($requ) {
            if (!empty($requ['from_date'])) {
                $q->where('created_at', '>=', ($requ['from_date']) . ' 00:00:00');
            }
            if (!empty($requ['to_date'])) {
                $q->where('created_at', '<=', ($requ['to_date']) . ' 23:59:59');
            }
        })->orderBy('id', 'DESC')
            ->get();
        return Excel::download(new ExportReport(['student' => $student, 'filter' => $filter, "viewpage" => "studentExport"]), 'Student-Slot-Listing.xlsx');
        // return Excel::download(new ExportReport(['student'=>$student,'filter'=>$filter,'requ'=>$requ,"viewpage" => "studentExport"]),'Student-Slot-Listing.xlsx');


    }

    public function  staff(Request $request)
    {


        $stander = Standerd::get();
        $requ = $request->all();
        $filter = [];
        if (!empty($request->status)) {
            $filter['status'] = $request->status;
        }
        $staff = User::where('isDeleted', 0)->where($filter)->where(function ($q) use ($requ) {
            if (!empty($requ['from_date'])) {
                $q->where('created_at', '>=', ($requ['from_date']) . ' 00:00:00');
            }
            if (!empty($requ['to_date'])) {
                $q->where('created_at', '<=', ($requ['to_date']) . ' 23:59:59');
            }
        })->paginate(10);
        $staff->appends($requ)->links();


        return view('report.staff', compact('staff', 'stander', 'requ'));
    }
    public function staffexport(Request $request)
    {
        $stander = Standerd::get();
        $requ = $request->all();
        $filter = [];
        if (!empty($request->status)) {
            $filter['status'] = $request->status;
        }
        $staff = User::where($filter)->where(function ($q) use ($requ) {
            if (!empty($requ['from_date'])) {
                $q->where('created_at', '>=', ($requ['from_date']) . ' 00:00:00');
            }
            if (!empty($requ['to_date'])) {
                $q->where('created_at', '<=', ($requ['to_date']) . ' 23:59:59');
            }
        })->orderBy('id', 'DESC')
            ->get();
            return Excel::download(
                new ExportReport(array(
                    'staff' => $staff,
                    'filter' => $filter,
                    'viewpage' => 'staffExport'
                )),
                'Student-Slot-Listing.xlsx'
            );
                    // return Excel::download(new ExportReport(['student'=>$student,'filter'=>$filter,'requ'=>$requ,"viewpage" => "studentExport"]),'Student-Slot-Listing.xlsx');


    }
}
