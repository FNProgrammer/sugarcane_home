<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions=Position::query()->paginate(3);
        return view('admin.position.positions',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view(' admin.position.create_position');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( PositionRequest  $request)
    {

         $position=Position::query()->create([
          'title'=>$request->input('title')
            ]);
             return redirect()->back()->with('message','سمت با موفقیت ایجاد شد ');
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
     $position=Position::query()->find($id);
        $positions=Position::query()->pluck('title','id');
    return view('admin.position.update_position',compact('position','positions'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, $id)
    {
        $position=Position::query()->find($id)->update([

            'title'=>$request->input('title')
        ]);
        /*return redirect()->back()->with('message','سمت با موفقیت ویرایش  شد ');*/
        return redirect('/admin/positions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $position= Position::query()->find($id);
        if (count($position->employee)>0)
        {
            return response()->json(false);
        }
        else
        {
            Position::destroy($id);
            return response()->json(true);

        }


    }


    public function searchPosition(Request  $request)
    {

          $search=$request->search;
        $positions=Position::query()->where('title','like','%'.$search.'%')->paginate(3);
        //  dd($positin);
        return view('admin.position.positions',compact('positions'));

    }
}
