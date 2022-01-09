@extends('admin.layouts.master')
@include('admin.partials.header')
@include('admin.partials.sidebar')
@section('content')

    <div class="col-xl-12 col-lg-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">  پرسنل</h4>
            </div>

            <div class="card-body">
                <div class="basic-form">
                    <form role="form" method="post"  action="{{route('employees.update',$employee->id)}}">
                        @csrf
                        @method('patch')
                        @if(Session::has('message'))
                            <div class="alert alert-secondary solid alert-rounded">
                                <strong>{{Session('message')}}</strong>
                            </div>
                        @endif()
                        @include('admin.partials.errors')
                        <div class="basic-form">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">شماره پرسنلی </label>
                                    <input type="number" name="employee_id"  class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;" value="{{$employee->employee_id}}">
                                </div>
                            </div>
                        </div>
                        <div class="basic-form">
                            <div class="row">
                                <div class="col-sm-6 mt-2 mt-sm-0">
                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">نام</label>
                                    <input type="text" name="name" class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;"  value="{{$employee->name}}">
                                </div>
                                <div class="col-sm-6 mt-2 mt-sm-0">
                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">نام خانوادگی</label>
                                    <input type="text" name="family" class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;"  value="{{$employee->family}}">
                                </div>
                            </div>
                        </div>
                        <div class="basic-form">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">کد ملی</label>
                                    <input type="number" name="national_id"  class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;" value="{{$employee->national_id}}">
                                </div>
                                <div class="col-sm-6 mt-2 mt-sm-0">
                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">شماره شناسنامه</label>
                                    <input type="number" name="certificate_id"  class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;" value="{{$employee->certificate_id}}">
                                </div>
                            </div>

                        </div>
                        <div class="basic-form">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">تعداد فرزند </label>
                                    <input type="number" name="child"   class="form-control input-rounded text-black"style="font-size: small; border-color:lightgrey;" value="{{$employee->child}}">
                                </div>
                            </div>
                        </div>

                        <div class="basic-form" style="margin-top: 1em">

                            <div class="row" style="margin-top: 1em">
                                <div class="col-sm-6" >

                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">شرکت</label>
                                    <div class="dropdown bootstrap-select form-control default-select" style="font-size: medium; border-color:lightgrey; border-radius: 100em;">

                                        <select id="inputState" name="company_id" class=" default-select input-rounded  form-control text-black "style="font-size: medium; border-color:lightgrey; border-radius: 100em;" tabindex="-98">
                                            @foreach($companies as $key=>$value)
                                                <option value="{{$key}}" class="form-control text-black input-rounded " style="font-size: medium; border-color:lightgrey; border-radius: 100em;" >{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-2 mt-sm-0">
                                    <label class="text-black "style="font-size: medium; border-color:lightgrey;">سمت </label>
                                    <div class="dropdown bootstrap-select form-control default-select" style="font-size: medium; border-color:lightgrey; border-radius: 100em;">

                                        <select id="inputState" name="position_id" class=" default-select input-rounded  form-control text-black "style="font-size: medium; border-color:lightgrey; border-radius: 100em;" tabindex="-98">
                                            @foreach($companies as $key=>$value)
                                                @if($employee->company_id == $key)
                                                    <option selected value="{{$key}}" class="form-control text-black "style="font-size: small">{{$value}}</option>
                                                @else
                                                    <option value="{{$key}}" class="form-control text-black "style="font-size: small">{{$value}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                            <div class="row" style="margin-top: 1em">

                            </div>
                            <div class=" card-title"style="font-size: small ;margin-top: 4em">
                                <input type="checkbox" name="status"   {{ $employee->status ? 'checked' : '' }} >
                                <label class="form-check-label"style="font-size: large ">
                                    فعال
                                </label>
                            </div>


                        <h4 class="card-title"></h4>

                        <a   href="{{route('employees.create')}}" >
                            <button type="submit" class="btn btn-rounded btn-outline-info" style="margin-right: 4em">ویرایش پرسنل </button>

                        </a>


                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

