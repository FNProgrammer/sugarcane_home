<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies=Company::query()->paginate(5);
            return view('admin.company.companies', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create_company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company=Company::query()->create([
            'cod'=>$request->input('cod'),
            'title'=>$request->input('title')
        ]);
        return redirect()->back()->with('message','شرکت با موفقیت ایجاد شد ');
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
        //
        $company=Company::query()->find($id);

        return view('admin.company.update_company',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company=Company::query()->find($id)->update([

            'cod'=>$request->input('cod'),
            'title'=>$request->input('title')
        ]);
            return redirect('/admin/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $company= Company::query()->find($id);
        if (count($company->employee)>0) {
            return response()->json(false);
        } else
        {
            Company::destroy($id);
            return response()->json(true);

        }
    }

        public function searchCompany(Request  $request)
    {

        $search=$request->search;
        $companies=Company::query()->where('title','like','%'.$search.'%')
            ->orWhere('cod','=',$search)
            ->paginate(3);

        return view('admin.company.companies',compact('companies'));



    }


}
