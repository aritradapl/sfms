<?php

namespace App\Http\Controllers\Admin\StudentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMaster;
use App\Models\Department;
use App\Models\Months;
use Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin_id =  Auth::user()->id;
        $data = UserMaster::with('department')->where('admin_id',$admin_id)->get();
        //dd($data);
        return view('admin\student_management\list',compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin_id =  Auth::user()->id;
        $dept=Department::where('admin_id',$admin_id)->get(['id','department_name']);
        //dd($dept);
        return view('admin\student_management\add',compact('dept'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'gender'=>'required',
            'phone'=>'required|digits_between:10,10',
            'address'=>'required',
            'dept_id'=>'required',
        ],
        [
            'name.required'=>'Name is Required',
            'gender.required'=>'Gender is Required',
            'phone.required'=>'Mobile is Required',
            'phone.digits_between'=>'Please Enter 10 Digit Mobile Number',
            'address.required'=>'Address is Required',
            'dept_id.required'=>'Department is Required',
        ]);
        $user= UserMaster::create([
            'admin_id' => Auth::user()->id,
            'name'=>$request->input('name'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'dept_id'=> $request->input('dept_id')
        ]);
        //dd($request->all());
        return redirect()->route('student.list')->with('status','Added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin_id =  Auth::user()->id;
        $data = UserMaster::with('department')->where('id',$id)->where('admin_id',$admin_id)->get();
        $dept=Department::where('admin_id',$admin_id)->get(['id','department_name']);
        //dd($data[0]->dept_id);
        return view('admin\student_management\edit',compact('data','dept'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user= UserMaster::where('id',$id)->update([
            'name'=>$request->input('name'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'dept_id'=> $request->input('dept_id')
        ]);
        return redirect()->route('student.list')->with('status','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = UserMaster::findOrFail($id);
        $student->delete();
        return back()->with('success', 'Student Deleted successfully.');
    }
}
