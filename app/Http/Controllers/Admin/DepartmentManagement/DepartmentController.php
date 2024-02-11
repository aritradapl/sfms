<?php

namespace App\Http\Controllers\Admin\DepartmentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Auth;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin_id =  Auth::user()->id;
        $data=Department::where('admin_id',$admin_id)->get();
        //dd($data);
        return view('admin\department_management\list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin\department_management\add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin_id = Auth::user()->id;
        $request->validate([
            'dept' => [
                'required',
                Rule::unique('department','department_name')->where(function ($query) use ($request,$admin_id) {
                    return $query->where('admin_id', $admin_id);
                }),
            ],
        ], [
            'dept.required' => 'Department Name is required',
            'dept.unique' => 'Department already exists.',
        ]);
        $obj = new Department();
        $obj->admin_id= $admin_id;
        $obj->department_name=$request->input('dept');
        $obj->save();
        return redirect()->route('department.list')->with('status','Added Successfully');
        dd($request->all());
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
        $department=Department::where('id',$id)->where('admin_id',$admin_id)->get();
        //dd($department);
        return view('admin\department_management\edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department= Department::where('id',$id)->update([
            'department_name'=>$request->input('dept'),
        ]);
        return redirect()->route('department.list')->with('status','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dept = Department::findOrFail($id);
        $dept->delete();
        return back()->with('success', 'Student Deleted successfully.');
    }
}
