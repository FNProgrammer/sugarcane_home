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
                    <form role="form" method="post"  action="{{route('home_prices.store' )}}">
                        @csrf
                        @if(Session::has('message'))
                            <div class="alert alert-secondary solid alert-rounded">
                                <strong>{{Session('message')}}</strong>
                            </div>
                        @endif()
                        @include('admin.partials.errors')


                        <div class="card-body">
                            <div class="basic-form">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="text-black "style="font-size: medium; border-color:lightgrey;">مبلغ اجاره </label>
                                            <input type="number"  name="price"  class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;" placeholder="مبلغ اجاره را وارد نمایید">
                                        </div>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label class="text-black "style="font-size: medium; border-color:lightgrey;">هزینه جبرانی</label>
                                            <input type="number"  name="Compensatory" class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;" placeholder="هزینه جبرانی را وارد نمایید">
                                        </div>
                                    </div>

                            </div>
                            <div class="basic-form">

                                <div class="row">
                                    <div class="col-sm-6"style="margin-top:1em">
                                        <label class="text-black "style="font-size: medium; border-color:lightgrey;">تاریخ شروع </label>
                                        <input  data-jdp data-jdp-min-date="today" name="from_date" class="form-control input-rounded  text-black "style="font-size: medium; border-color:lightgrey;" id="datepicker-default"placeholder="1400/01/01">
                                    </div>
                                    <div class="col-sm-6 mt-2 mt-sm-0"style="margin-top:1em">
                                        <label class="text-black "style="font-size: medium; border-color:lightgrey;margin-top: 1em">تاریخ پایان</label>
                                        <input  data-jdp data-jdp-min-date="today" name="to_date" class="form-control  input-rounded  text-black "style="font-size: medium; border-color:lightgrey;" id="datepicker-default"placeholder="1400/01/01">
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
                                                <option value="{{$key}}" class="form-control text-black input-rounded " style="font-size: medium; border-color:lightgrey; border-radius: 100em;" >{{$value}}</option>
                                                @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <label class="form-check-label">
                                    </label>
                                        <div class=" card-title"style="font-size: small ;margin-top: 4em">
                                        <input type="checkbox" name="status"  checked="checked" value="true" style="font-size: large ">
                                        <label class="form-check-label"style="font-size: large ">
                                            فعال
                                        </label>
                                </div>
                            </div>

                        </div>






                        <h4 class="card-title"></h4>

                            <a   href="{{route('home_prices.create')}}" >
                                <button type="submit" class="btn btn-rounded btn-outline-info" style="margin-right: 4em">ثبت اجاره بها جدید</button>

                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

