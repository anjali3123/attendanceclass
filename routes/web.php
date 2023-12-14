<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StanderdController;
use App\Http\Controllers\ClassroomCantroller;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\DayCantroller;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('verify', [AuthController::class, 'login'])->name('login.verify');
Route::get('/login/forgot', [AuthController::class, 'forgot'])->name('login.forgot');
Route::post('/login/sendforgetlink', [AuthController::class, 'sendforgetlink'])->name('login.sendforgetlink');
Route::get('/login/showResetPasswordForm/{token}', [AuthController::class, 'showResetPasswordForm'])->name('login.showResetPasswordForm');
Route::post('/login/submitResetPasswordForm', [AuthController::class, 'submitResetPasswordForm'])->name('login.submitResetPasswordForm');

Route::group(['middleware' => ['auth']], function () {
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::post('dashboard/get', [DashboardController::class, 'get'])->name('dashboard.get');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::get('/user/changepassword', [UserController::class, 'passwordchange'])->name('user.changepassword');
Route::post('/user/passwordupdate', [UserController::class, 'passwordupdate'])->name('user.passwordupdate');


Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');

Route::get('/staff/add', [StaffController::class, 'add'])->name('staff.add');
Route::post('/staff/create', [StaffController::class, 'create'])->name('staff.create');
Route::get('/staff/list', [StaffController::class, 'list'])->name('staff.list');
Route::get('/staff/get/{id}', [StaffController::class, 'get'])->name('staff.get');
Route::post('/staff/update', [StaffController::class, 'update'])->name('staff.update');
Route::post('/staff/status', [StaffController::class, 'status'])->name('staff.status');
Route::post('/staff/delete', [StaffController::class, 'delete'])->name('staff.delete');

Route::get('/division', [DivisionController::class, 'index'])->name('division.index');
Route::get('/division/list', [DivisionController::class, 'list'])->name('division.list');
Route::post('/division/add', [DivisionController::class, 'store'])->name('division.store');
Route::post('/division/edit', [DivisionController::class, 'edit'])->name('division.edit');
Route::get('/division/get', [DivisionController::class, 'get'])->name('division.get');
Route::post('/division/delete', [DivisionController::class, 'delete'])->name('division.delete');



Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');
Route::get('/subject/list', [SubjectController::class, 'list'])->name('subject.list');
Route::post('/subject/add', [SubjectController::class, 'store'])->name('subject.store');
Route::post('/subject/edit', [SubjectController::class, 'edit'])->name('subject.edit');
Route::get('/subject/get', [SubjectController::class, 'get'])->name('subject.get');

Route::post('/subject/delete', [SubjectController::class, 'delete'])->name('subject.delete');

Route::get('/student', [StudentController::class, 'index'])->name('student.index');
Route::get('/button', [StudentController::class, 'button'])->name('student.button');
Route::post('/button/add', [StudentController::class, 'addbutton'])->name('student.addbutton');
Route::get('/student/get', [StudentController::class, 'get'])->name('student.get');
Route::get('/student/add', [StudentController::class, 'create'])->name('student.add');
Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');
Route::get('/student/list', [StudentController::class, 'list'])->name('student.list');
Route::get('/student/downloadFile', [StudentController::class, 'downloadFile'])->name('student.downloadFile');
Route::post('/student/update', [StudentController::class, 'update'])->name('student.update');
Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::post('/student/import', [StudentController::class, 'import'])->name('student.import');
Route::post('/student/delete', [StudentController::class, 'delete'])->name('student.delete');


Route::get('/standerd', [StanderdController::class, 'index'])->name('standerd.index');
Route::get('/standerd/list', [StanderdController::class, 'list'])->name('standerd.list');
Route::get('/standerd/create/{id}', [StanderdController::class, 'create'])->name('standerd.create');
Route::post('/standerd/store/{id}', [StanderdController::class, 'store'])->name('standerd.store');
Route::get('/standerd/get/{id}', [StanderdController::class, 'get'])->name('standerd.get');
Route::post('/standerd/update/{id}', [StanderdController::class, 'update'])->name('standerd.update');
Route::get('/standerd/divget', [StanderdController::class, 'getdiv'])->name('standerd.getdiv');
Route::post('/standerd/add', [StanderdController::class, 'add'])->name('standerd.add');



Route::get('/class', [ClassroomCantroller::class, 'index'])->name('class.index');
Route::get('/class/list', [ClassroomCantroller::class, 'list'])->name('class.list');


Route::get('/timetable', [TimetableController::class, 'index'])->name('timetable.index');
Route::post('/timetable/store', [TimetableController::class, 'store'])->name('timetable.store');
Route::get('/timetable/get', [TimetableController::class, 'get'])->name('timetable.get');
Route::post('/timetable/day', [TimetableController::class, 'day'])->name('timetable.day');


Route::get('/day', [DayCantroller::class, 'index'])->name('day.index');
Route::get('/day/list', [DayCantroller::class, 'list'])->name('day.list');
Route::get('/day/add/{id}', [DayCantroller::class, 'add'])->name('day.add');


Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::get('/calendar/show', [CalendarController::class, 'show'])->name('calendar.show');
Route::post('/calendar/add', [CalendarController::class, 'add'])->name('calendar.add');


Route::get('/report/student', [ReportController::class, 'student'])->name('report.student');
Route::get('/report/studentexport', [ReportController::class, 'export'])->name('report.studentexport');
Route::get('/report/staff', [ReportController::class, 'staff'])->name('report.staff');
Route::get('/report/staffexport', [ReportController::class, 'staffexport'])->name('report.staffexport');
});
