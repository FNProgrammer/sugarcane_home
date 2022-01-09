<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::query()->where('status','=',1)->paginate(5);
        return view('admin.employee.employees', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::query()->pluck('title', 'id');
        $positions = Position::query()->pluck('title', 'id');
        return view('admin.employee.create_employee',compact('companies','positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {   //dd($request->all());
        $status = 1;
        if ($request->status == null) {
            $status = 0;
        }
        $employee = Employee::query()->create([
            'employee_id' => $request->input('employee_id'),
            'name' => $request->input('name'),
            'family' => $request->input('family'),
            'national_id' => $request->input('national_id'),
            'certificate_id' => $request->input('certificate_id'),
            'child' => $request->input('child'),
            'company_id' => $request->input('company_id'),
            'position_id' => $request->input('position_id'),
            'status'=>$status

        ]);
        return redirect()->back()->with('message', 'پرسنل با موفقیت ایجاد شد ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::query()->find($id);
        $positions=Position::query()->pluck('title', 'id');
        $companies=Company::query()->pluck('title', 'id');
        return view('admin.employee.update_employee', compact('employee','positions','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $status = 1;
        if ($request->status == null) {
            $status = 0;
        }
        $employee = Employee::query()->find($id)->update([
            'employee_id' => $request->input('employee_id'),
            'name' => $request->input('name'),
            'family' => $request->input('family'),
            'national_id' => $request->input('national_id'),
            'certificate_id' => $request->input('certificate_id'),
            'child' => $request->input('child'),
            'company_id' => $request->input('company_id'),
            'position_id' => $request->input('position_id'),
            'status'=>$status
        ]);
        return redirect('/admin/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $employee= Employee::query()->find($id);
        if (count($employee->contract)>0  )
        {
            return  Response()->json(false);

        } else {

            Employee::destroy($id);
            return Response()->json(true);


        }
    }
    public function searchEmployee(Request  $request)
    {

        $search=$request->search;
        $employees=Employee::query()->where('employee_id','=',$search)
            ->orWhere('name','like','%'.$search.'%')
            ->orWhere('family','like','%'.$search.'%')
            ->orWhere('national_id','=',$search)
            ->orWhere('certificate_id','=',$search)
            ->orWhere('child','=',$search)
            ->orWhereHas('position', function ($q)use($search){
                $q->where('title','like','%'.$search.'%');
            })->with('position')->latest()
             ->orWhereHas('company', function ($q)use($search){
                $q->where('title','like','%'.$search.'%');
            })->with('company')->latest()
            ->paginate(3);
        //  dd($positin);
        return view('admin.employee.employees',compact('employees'));

    }

}
