<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomePriceRequest;
use App\Models\Home;
use App\Models\HomeKind;
use App\Models\HomePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class HomePriceController extends Controller
{
    public function index()
    {
        $home_prices = HomePrice::query()->where('status','=' ,1)->paginate(5);

        $home_prices2 = HomePrice::query()->where('status','=' ,1)->get();
        @Foreach($home_prices2 as $home_prices2)

        $unit = $home_prices2->from_date;
        $yrdata= strtotime( $unit );

        $timestampDay = date('d',$yrdata);

        dd( $unit);

          @endforeach
        return view('admin.home_price.home_prices', compact('home_prices'));
    }


    public function create()
    {
        $home_kinds = HomeKind::query()->pluck('title', 'id');
        return view('admin.home_price.create_home_price',compact('home_kinds'));
    }


    public function store(HomePriceRequest $request)
    {   $unit = $request->input('from_date');
        $unit2 = $request->input('to_date');
        $yrdata= strtotime( $unit );
        $yrdata2= strtotime( $unit2 );
        $timestampDay = date(' d',$yrdata);
        $timestampDay2 = date(' d',$yrdata2);
       $date= $timestampDay-$timestampDay2;
        dd( $date);

        $status = 1;
        if ($request->status == null) {
            $status = 0;
        }

        $home_kind_id = $request->input('home_kind_id');

        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $existHome_kind = HomePrice::query()->where('home_kind_id', $home_kind_id)->exists();
        $existHomeType = HomePrice::query()
            ->whereBetween('from_date',[$from_date,$to_date])
            ->whereBetween('to_date',[ $from_date,$to_date])->exists();

        if ($existHomeType && $status==1 && $existHome_kind )
        {
            return back()->with('message', 'در این بازه زمانی برای این نوع منزل مبلغ فعال وجود دارد');
        }
        else {

                $home_price = HomePrice::query()->create([
                    'home_kind_id' => $request->input('home_kind_id'),
                    'price' => $request->input('price'),
                    'Compensatory' => $request->input('Compensatory'),
                    'from_date' => $request->input('from_date'),
                    'to_date' => $request->input('to_date'),
                    'status' => $status


                ]);
                return redirect()->back()->with('message', 'اجاره بها با موفقیت ایجاد شد ');
            }


        ////////////

    }

    public function show($id)
    {
//        مثال

        // $existfrom_date  = HomePrice::query()->where('price', 1000)->exists();
        //   return true  or false

        //  $titles = DB::HomePrice('home_type');

        // foreach ($titles as $title) {

        //  $existHomeType = HomePrice::query()->where('home_type',$title)->exists();
        //  }


        //if($existPrice && $existHomeType){
        //   return back()->with('message', 'not allowded');
        // }else{

        //   }

//        اینجوری

        //   $foo  = HomePrice::query()->where(Carbon::parse('foo_date')->format('Y-m-d'), now())->exists();
        // something like this


        // another way to check uniqu date in validation

    }


    public function edit($id)
    {
        $home_price = HomePrice::query()->find($id);
        $home_kinds = HomeKind::query()->pluck('title', 'id');
        return view('admin.home_price.update_home_price', compact('home_price','home_kinds'));
    }


    public function update(HomePriceRequest $request, $id)
    {
        $status = 1;
        if ($request->status == null)
        {
            $status = 0;
              }




            $home_price = HomePrice::query()->find($id)->update([

                'home_kind_id' => $request->input('home_kind_id'),
                'price' => $request->input('price'),
                'Compensatory' => $request->input('Compensatory'),
                'from_date' => $request->input('from_date'),
                'to_date' => $request->input('to_date'),
                'status' => $status
            ]);
            return redirect('/admin/home_prices');
       // }
       // }
    }

    public function destroy($id)
    {

        $home_price= HomePrice::query()->find($id);
        if (count($home_price->home_prices)>0) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }

    public function searchHomePrice(Request  $request)
    {

        $search=$request->search;
        $home_prices=HomePrice::query()->where('price','=',$search)
            ->orWhere('Compensatory','=',$search)
            ->orWhere('from_date','=',$search)
            ->orWhere('to_date','=',$search)
            ->orWhere('status','=',$search)
->orWhereHas('home_kind', function ($q)use($search){

    $q->where('title','like','%'.$search.'%');
})->with('home_kind')->latest()
            ->paginate(3);
        //  dd($positin);
        return view('admin.home_price.home_prices',compact('home_prices'));

    }


}
