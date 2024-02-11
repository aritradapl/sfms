<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StudentManagement\StudentController;
use App\Http\Controllers\Admin\FeesManagement\FeesController;
use App\Http\Controllers\Admin\DepartmentManagement\DepartmentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/admin/student/list',[StudentController::class,'index'])->name('student.list');
Route::get('/admin/student/add',[StudentController::class,'create'])->name('student/add');
Route::POST('/admin/student/add',[StudentController::class,'store'])->name('student/register');
Route::get('/admin/student/edit/{id}',[StudentController::class,'edit'])->name('student.edit');
Route::Post('/admin/student/edit/{id}',[StudentController::class,'update'])->name('student.edit.post');
Route::get('/admin/student/delete/{id}',[StudentController::class,'destroy'])->name('student.delete');

Route::get('/admin/student/fees',[FeesController::class,'index'])->name('fees/list');
Route::get('/admin/student/add_student_fees',[FeesController::class,'create'])->name('add.fees');
Route::Post('/admin/student/add_student_fees',[FeesController::class,'store'])->name('fees.post');
Route::get('/admin/student_fees_details/{id}',[FeesController::class,'showFees'])->name('fees.show');
Route::post('/generate-pdf/{id}', [FeesController::class, 'generatePDF'])->name('pdf.generate');
Route::get('/delete-fees-details/{id}', [FeesController::class, 'destroy'])->name('fees.delete');


Route::get('/admin/department/list',[DepartmentController::class,'index'])->name('department.list');
Route::get('/admin/add_department',[DepartmentController::class,'create'])->name('add.department');
Route::Post('/admin/add_department',[DepartmentController::class,'store'])->name('department.post');
Route::get('/admin/department/edit/{id}',[DepartmentController::class,'edit'])->name('department.edit');
Route::Post('/admin/department/edit/{id}',[DepartmentController::class,'update'])->name('department.edit.post');
Route::get('/admin/department/delete/{id}',[DepartmentController::class,'destroy'])->name('department.delete');

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
