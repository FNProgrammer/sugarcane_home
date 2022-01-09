@extends('admin.layouts.master')
@include('admin.partials.header')
@include('admin.partials.sidebar')
@section('content')

    <div class="col-xl-12 col-lg-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> اجاره بها منازل سازمانی</h4>
            </div>

            <div class="card-body">
                <div class="basic-form">
                    <form role="form" method="post"  action="{{route('home_prices.update',$home_price->id)}}">
                        @csrf
                        @method('patch')
                        @if(Session::has('message'))
                            <div class="alert alert-secondary solid alert-rounded">
                                <strong>{{Session('message')}}</strong>
                            </div>
                        @endif()
                        @include('admin.partials.errors')
                        <div class="basic-form">
                        <div class="basic-form">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">مبلغ اجاره </label>
                                    <input type="number"  name="price"  class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;"  value="{{$home_price->price}}">
                                </div>
                                <div class="col-sm-6 mt-2 mt-sm-0">
                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">هزینه جبرانی</label>
                                    <input type="number"  name="Compensatory" class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;" value="{{$home_price->Compensatory}}">
                                </div>
                            </div>

                        </div>

                        <div class="basic-form">

                            <div class="row">
                                <div class="col-sm-6"style="margin-top:1em">
                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">تاریخ شروع </label>
                                    <input  data-jdp data-jdp-min-date="today" name="from_date" class="form-control input-rounded  text-black "style="font-size: medium; border-color:lightgrey;" id="datepicker-default" value="{{$home_price->from_date}}">
                                </div>
                                <div class="col-sm-6 mt-2 mt-sm-0"style="margin-top:1em">
                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;margin-top: 1em">تاریخ پایان</label>
                                    <input  data-jdp data-jdp-min-date="today" name="to_date" class="form-control  input-rounded  text-black "style="font-size: medium; border-color:lightgrey;" id="datepicker-default"value="{{$home_price->to_date}}">
                                </div>
                            </div>

                        </div>
                        <div class="basic-form" style="margin-top: 1em">

                            <div class="row" style="margin-top: 1em">
                                <div class="col-sm-6" style="margin-top: 1em">

                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">نوع منزل </label>
                                    <div class="dropdown bootstrap-select form-control default-select" style="font-size: medium; border-color:lightgrey; border-radius: 100em;">
                                        <select id="inputState" name="home_kind_id" class=" default-select input-rounded  form-control text-black "style="font-size: medium; border-color:lightgrey; border-radius: 100em;" tabindex="-98">
                                            @foreach($home_kinds as $key=>$value)
                                                @if($home_price->home_kind_id == $key)
                                                    <option selected value="{{$key}}" class="form-control text-black "style="font-size: small">{{$value}}</option>
                                                @else
                                                    <option value="{{$key}}"class="form-control text-black "style="font-size: small">{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label class="form-check-label">
                                </label>
                                <div class=" card-title"style="font-size: small ;margin-top: 4em">
                                    <input type="checkbox" checked="checked" name="status" value="1" >

                                    <label  class="form-check-label "style="font-size: large ">
                                        فعال
                                    </label>
                                </div>
                            </div>

                        </div>



                        <h4 class="card-title"></h4>

                        <a   href="{{route('home_prices.create')}}" >
                            <button type="submit" class="btn btn-rounded btn-outline-info" style="margin-right: 4em">ویرایش اجاره بها </button>

                        </a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

