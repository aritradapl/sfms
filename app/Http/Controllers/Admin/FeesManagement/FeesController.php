<?php

namespace App\Http\Controllers\Admin\FeesManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMaster;
use App\Models\Department;
use App\Models\Months;
use App\Models\Amount;
use App\Models\YearModel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use PDF;
use Auth;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin_id =  Auth::user()->id;
        $months = Months::with('payments')->get();
        $students = UserMaster::with(['amounts', 'department'])->where('admin_id',$admin_id)->get();
        $dept =Department::where('admin_id',$admin_id)->get();
        $years = YearModel::all();
        //dd($students,$months);
        return view('admin/fees_management/list', compact('students','months','dept','years'));
    }
    public function generatePDF(string $id)
    {
        $months = Months::with('payments')->get();
        $student = UserMaster::with(['amounts', 'department'])->where('id',$id)->get();

        $pdf = PDF::loadView('admin.fees_management.show_fees',compact('student','months'));
        //dd($pdf);

        return $pdf->download('fees_details.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin_id =  Auth::user()->id;
        $students = UserMaster::where('admin_id',$admin_id)->get(["name", "id"]);
        $months = Months::get(["month_name", "id"]);
        $years = YearModel::get(["year", "id"]);
        //dd($students,$months);
        return view('admin/fees_management/add',compact(
            'students','years','months'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id'=>'required',
            'year_id' => 'required',
            'month_id' => [
                'required',
                Rule::unique('amount_table')->where(function ($query) use ($request) {
                    return $query->where('student_id', $request->student_id)
                                 ->where('year_id', $request->year_id);
                })
            ],
            'amount'=>'required'
        ],
        [
            'student_id.required'=>'Student Name is required',
            'year_id.required' =>'Year is required',
            'month_id.required'=>'Month is required',
            'month_id.unique'=>'Fees Already Paid for this month',
            'amount.required'=>'Amount is required'
        ]);
        $obj = new Amount();
        $obj->admin_id=Auth::user()->id;
        $obj->student_id=$request->input('student_id');
        $obj->year_id=$request->input('year_id');
        $obj->month_id=$request->input('month_id');
        $obj->amount=$request->input('amount');
        $obj->save();
        return redirect()->route('fees/list')->with('status','Added Successfully');
    }
    public function showFees(string $id)
    {
        //dd($id);
        $months = Months::with('payments')->get();
        $admin_id =  Auth::user()->id;
        $student = UserMaster::with(['amounts', 'department'])->where('id',$id)->where('admin_id',$admin_id)->get();
        $years = YearModel::all();
        //dd($student);
        return view('admin.fees_management.show_fees',compact('student','months','years'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $amount = Amount::findOrFail($id);
        $amount->delete();
        return back()->with('success', 'Data Deleted successfully.');
    }
}
