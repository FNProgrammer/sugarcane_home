@extends('admin.layouts.master')
@include('admin.partials.header')
@include('admin.partials.sidebar')
@section('content')

    <div class="col-xl-12 col-lg-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">لیست قراردادها</h4>
            </div>
            @if(Session::has('message'))
                <div class="alert alert-secondary solid alert-rounded">
                    <strong>{{Session('message')}}</strong>
                </div>
            @endif()
            <?php $i = (isset($_GET['page'])) ? (($_GET['page'] - 5) * 3) + 1 : 1; ?>
            <div class="card-body">
                <div class="table-responsive">
                    <div id=" example3_wrapper"  class=" dataTables_wrapper no-footer">
                        <div >
                            <form action="{{route('search.contracts')}}" method="get">
                                <a  class="btn btn-rounded btn-outline-info"  style=" margin-top: 4em;margin-right: 2em  " href="{{route('contracts.create')}}" >
                                    <i class="fa fa-plus"></i>
                                    <i  style="font-family:iransans-normal"> ایجاد قرارداد جدید</i>
                                </a>
                                <a  class="btn btn-rounded  btn-outline-info"  style=" margin-top: 4em;margin-right: 2em  " href="{{route('contract.exel')}}" >
                                    <i class="fa fa-file-excel-o"></i>
                                    <i  style="font-family:iransans-normal" > ارسال خروجی به اکسل</i>
                                </a>
                                <div class="input-group search-area form-control input-rounded" id="example5_filter" style="border-color:lightgrey;  float: left;height: 49px ;margin-left: 1em ;margin-right: 2em  ;margin-bottom: 1em ;margin-top: 3em "  class="dataTables_filter">
                                    <input type="text"   name="search" class="form-control d-xl-inline-flex d-none" style=" border-color: transparent" placeholder=" جستجو ">
                                    <div class="input-group-append">
                                        <button class="input-group-text">
                                            <i class="flaticon-381-close"></i>
                                        </button>
                                        <button class="input-group-text" >
                                            <i class="flaticon-381-search-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table id="example3" class="display table-responsive-lg  table-bordered table-striped  dataTable no-footer" role="grid" aria-describedby="example3_info">
                        <thead>
                        <tr>
                            <th class="text-center align-middle">ردیف</th>
                            <th class="text-center align-middle">شماره پرسنلی</th>
                            <th class="text-center align-middle">نام پرسنل </th>
                            <th class="text-center align-middle">شماره پلاک</th>
                            <th class="text-center align-middle">تاریخ شروع</th>
                            <th class="text-center align-middle">تاریخ پایان</th>
                            <th class="text-center align-middle">فعال</th>
                            <th class="text-center align-middle">توضیحات</th>
                            <th class="text-center align-middle">تاریخ ایجاد</th>
                            <th class="text-center align-middle">تاریخ ویرایش</th>
                            <th class="text-center align-middle">ویرایش</th>
                            <th class="text-center align-middle"> حذف</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contracts as $contract)
                            <tr>
                                <td class="text-center align-middle">{{$i++}}</td>

                                <td class="text-center align-middle">{{($contract->employee->employee_id)}}</td>
                                <td class="text-center align-middle">{{($contract->employee->getFullName())}}</td>
                                <td class="text-center align-middle">{{($contract->home->getHomeName())}}</td>
                                <td class="text-center align-middle">{{($contract->start_date)}}</td>
                                <td class="text-center align-middle">{{($contract->end_date)}}</td>
                                  @if($contract->status == 0)
                                    <td class="form-check-input" name="status" type="checkbox" >غیرفعال</td>
                                @else
                                    <td class="form-check-input" name="status" type="checkbox" >فعال</td>
                                @endif
                                <td class="text-center align-middle">{{($contract->enddate)}}</td>
                                <td class="text-center align-middle">{{Hekmatinasser\Verta\Verta::instance( $contract->created_at)->format('%B %d، %Y')}}</td>
                                <td class="text-center align-middle">{{Hekmatinasser\Verta\Verta::instance( $contract->updated_at)->format('%B %d، %Y')}}</td>
                                <td class="text-center align-middle">
                                    <a class=" btn btn-rounded btn-outline-info"
                                       href="{{route('contracts.edit',$contract->id)}}">
                                        <i class="fa fa-edit"></i>
                                        <i  style="font-family: iransans-normal"> ویرایش</i>
                                    </a>

                                </td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-rounded btn-outline-danger"
                                            onclick="deleteItem({{$contract->id}})">
                                        <i class="fa fa-close"></i>
                                        <i  style="font-family: iransans-normal"> حذف</i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav style="margin-top: 1em ;float: right ;margin-left: 4em">
                        <ul class="pagination pagination-circle">
                            <li class="page-item page-indicator">
                            </li>
                            </li>
                            {{$contracts->links()}}
                            <li class="page-item page-indicator">
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف قرارداد',
                text: "آیا از حذف  قرارداد مطمئن هستید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {



                    $.ajax(
                        {
                            url: 'http://127.0.0.1:8000/admin/contracts/' +id,
                            type: 'delete',
                            dataType: "JSON",
                            data: {
                                _token:"{{csrf_token()}}",
                                "id": id
                            },
                            success: function (response)
                            {
                                if(response==false){
                                    Swal.fire(
                                        'شرکت حذف نشد',
                                        'شرکت مورد نظر در جداول دیگر استفاده شده است',
                                        'باشه'
                                    );}
                                else{

                                    Swal.fire(
                                        'شرکت حذف شد',
                                        'شرکت مورد نظر با موفقیت حذف شد',
                                        'باشه'
                                    );}

                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });

                  //  location.reload();
                }
            });
        }
    </script>
@endsection

