<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ContractExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContractRequest;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::query()->paginate(5);

        return view('admin.contract.contracts', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $employees = DB::table('employees')->where('status', 1)->select('id', DB::raw("CONCAT(employees.name,' ',employees.family) AS full_name"))->get()->pluck('full_name', 'id');
        $homes = DB::table('homes')->select('id', DB::raw("CONCAT( 'بلوک' , homes.district,' واحد ',homes.unit) AS full_name"))->get()->pluck('full_name', 'id');

        return view('admin.contract.create_contract', compact('employees', 'homes'));
    }

    public function store(ContractRequest $request)
    {//dd($request->all());
        $status = 1;
        if ($request->status == null) {
            $status = 0;
        }
        /////////////////////////////////////
        $employee_id = $request->input('employee_id');

        $home_id = $request->input('home_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');


        $existHomeId = Contract::query()->where('home_id', $home_id)->exists();
        $existEmployee = Contract::query()->where('employee_id', $employee_id)
            ->where('status', '=', 1)->exists();
        //$homes=DB::table('homes')
        //  ->join('home_kinds','home_kinds.id','homes.home_kind_id')
        //  ->join('home_prices','home_prices.home_kind_id','home_kinds.id')
        // ->select('from_date','to_date')->get();

        if (($existHomeId && $status == 1) || $existEmployee) {
            return back()->with('message', 'در این بازه زمانی برای این نوع پرسنل/ منزل قرارداد  فعال وجود دارد');
        } else {
            $contract = Contract::query()->create([
                'employee_id' => $request->input('employee_id'),
                'home_id' => $request->input('home_id'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'status' => $status,
                'description' => $request->input('description'),


            ]);
            return redirect()->back()->with('message', 'قرارداد با موفقیت ایجاد شد ');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = Contract::query()->find($id);
        $employees = DB::table('employees')->where('status', 1)->select('id', DB::raw("CONCAT(employees.name,' ',employees.family) AS full_name"))->get()->pluck('full_name', 'id');
        $homes = DB::table('homes')->select('id', DB::raw("CONCAT( 'بلوک' , homes.district,' واحد ',homes.unit) AS full_name"))->get()->pluck('full_name', 'id');

        return view('admin.contract.update_contract', compact('contract', 'employees', 'homes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequest $request, $id)
    {
        $status = 1;
        if ($request->status == null) {
            $status = 0;
        }
        $employee_id = $request->input('employee_id');

        $home_id = $request->input('home_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');


        $existHomeId = Contract::query()->where('home_id', $home_id)->exists();
        $existEmployee = Contract::query()->where('employee_id', $employee_id)
            ->where('status', '=', 1)->exists();

        if (($existHomeId && $status == 1) || $existEmployee) {
            return back()->with('message', 'در این بازه زمانی برای این نوع پرسنل/ منزل قرارداد  فعال وجود دارد');
        } else {
            $contract = Contract::query()->find($id)->update([
                'employee_id' => $request->input('employee_id'),
                'home_id' => $request->input('home_id'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'status' => $status,
                'description' => $request->input('description'),
            ]);
            return redirect('/admin/contracts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $contract = Contract::query()->find($id);
        if (count($contract->contracts) > 0) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }

    public function searchContract(Request $request)
    {
        $search = $request->search;
     $contracts = Contract::query()->where('start_date', '=', $search)
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('end_date', 'like', '%' . $search . '%')
            ->orWhereHas('employee', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
                $q->orwhere('family', 'like', '%' . $search . '%');
                $q->orwhere('employee_id', '=', $search);

            })->with('employee')->latest()
            ->orWhereHas('home', function ($q) use ($search) {
                $q->where('district', '=', $search);
                $q->orwhere('unit', '=', $search);
            })->with('home')->latest()
            ->paginate(5);

         Excel::download(new ContractExport($contracts),'Contract-exel.xlsx');
        return view('admin.contract.contracts', compact('contracts'));


    }

    public function exportExel(Request $request)
    {
        $search = $request->value;

        $contracts = Contract::query()->where('start_date', '=', $search)
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('end_date', 'like', '%' . $search . '%')
            ->orWhereHas('employee', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
                $q->orwhere('family', 'like', '%' . $search . '%');
                $q->orwhere('employee_id', '=', $search);

            })->with('employee')->latest()
            ->orWhereHas('home', function ($q) use ($search) {
                $q->where('district', '=', $search);
                $q->orwhere('unit', '=', $search);
            })->with('home')->get();
       // $contracts=Contract::query()->get();
        return Excel::download(new ContractExport($contracts),'Contract-exel.xlsx');

    }
}
