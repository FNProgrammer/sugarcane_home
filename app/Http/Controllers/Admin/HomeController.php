<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeRequest;
use App\Models\Home;
use App\Models\HomeKind;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homes = Home::query()->paginate(5);
        return view('admin.home.homes', compact('homes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home_kinds = HomeKind::query()->pluck('title', 'id');
        return view('admin.home.create_home',compact('home_kinds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomeRequest $request)
    {
     //  dd($request->all());

        $rent = 1;
        if ($request->rent == null) {
            $rent = 0;
        }
        $district = $request->input('district');

        $unit = $request->input('unit');

        $existDistrict = Home::query()->where('district', $district)->exists();
        $existUnit = Home::query()->where('unit', $unit)->exists();

        if ($existUnit  && $existDistrict)
        {
            return back()->with('message', 'این منزل تعریف شده است');
        }
        else {

            $home = Home::query()->create([
                'district' => $request->input('district'),
                'unit' => $request->input('unit'),
                'rent' => $rent,
                'home_kind_id' => $request->input('home_kind_id')


            ]);
            return redirect()->back()->with('message', 'منزل با موفقیت ایجاد شد ');
        }



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
        $home = Home::query()->find($id);
        $home_kinds = HomeKind::query()->pluck('title', 'id');
        return view('admin.home.update_home', compact('home', 'home_kinds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HomeRequest $request, $id)
    { //dd($request->all());
        $rent = 1;
        if ($request->rent == null)
        {
            $rent = 0;
        }

        $home = Home::query()->find($id)->update([

            'district' => $request->input('district'),
                'unit' => $request->input('unit'),
                'rent' => $rent,
                'home_kind_id' => $request->input('home_kind_id')
        ]);
        return redirect('/admin/homes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $home= Home::query()->find($id);
        if (count($home->contract)>0) {
            return response()->json(false);
        } else
        {
            Home::destroy($id);
            return response()->json(true);
        }
    }
    public function searchHome(Request  $request)
    {

        $search=$request->search;
        $homes=Home::query()->where('district','=',$search)
            ->orWhere('unit','=',$search)

            ->orWhere('rent','=',$search)
            ->orWhereHas('home_kind', function ($q)use($search){
                $q->where('title','like','%'.$search.'%');
            })->with('home_kind')->latest()
            ->paginate(3);

        return view('admin.home.homes',compact('homes'));

    }

}
