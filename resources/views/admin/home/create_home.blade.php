@extends('admin.layouts.master')
@include('admin.partials.header')
@include('admin.partials.sidebar')

@section('content')

    <div class="col-xl-12 col-lg-12">

        <div class="card">
            <div class="card-header">
                {{ Breadcrumbs::render('createHomes') }}
            </div>

            <div class="card-body">
                <div class="basic-form">
                    <form role="form" method="post"  action="{{route('homes.store' )}}">
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
                                        <label class="text-black "style="font-size: medium; border-color:lightgrey;">بلوک </label>
                                        <input type="number"  name="district"  class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;" placeholder="بلوک را وارد نمایید">
                                    </div>
                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <label class="text-black "style="font-size: medium; border-color:lightgrey;">واحد</label>
                                        <input type="number"  name="unit" class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;" placeholder="واحد را وارد نمایید">
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
                                        <input type="checkbox" name="rent"  checked="checked" value="true" style="font-size: large ">
                                        <label class="form-check-label"style="font-size: large ">
                                            مستاجر
                                        </label>
                                    </div>
                                </div>

                            </div>









                        <h4 class="card-title"></h4>

                            <a   href="{{route('homes.create')}}" >
                                <button type="submit" class="btn btn-rounded btn-outline-info" style="margin-right: 4em">ثبت منزل جدید</button>

                            </a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

