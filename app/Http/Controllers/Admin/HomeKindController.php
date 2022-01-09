<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeKind;
use Illuminate\Http\Request;

class HomeKindController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home_kinds=HomeKind::query()->paginate(3);
        return view('admin.home_kind.home_kinds',compact('home_kinds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home_kind.create_home_kind');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $home_kind=HomeKind::query()->create([
            'title'=>$request->input('title')
        ]);
        return redirect()->back()->with('message','خانه  با موفقیت ایجاد شد ');
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
        $home_kind=HomeKind::query()->find($id);
     //   $home_kind=HomeKind::query()->pluck('title','id');
        return view('admin.home_kind.update_home_kind',compact('home_kind','home_kind'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $home_kind=HomeKind::query()->find($id)->update([

            'title'=>$request->input('title')
        ]);
        /*return redirect()->back()->with('message','سمت با موفقیت ویرایش  شد ');*/
        return redirect('/admin/home_kinds');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $home_kind=HomeKind::query()->find($id);

        if (count($home_kind->home)>0||count($home_kind->home_price)>0) {
            return response()->json(false);
        } else {
            HomeKind::destroy($id);
           return response()->json(true);
        }

    }

    public function searchHomeKind(Request  $request)
    {

        $search=$request->search;
        $home_kinds=HomeKind::query()->where('title','like','%'.$search.'%')->paginate(3);

        return view('admin.home_kind.home_kinds',compact('home_kinds'));

    }

}
