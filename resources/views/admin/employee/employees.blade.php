@extends('admin.layouts.master')
@include('admin.partials.header')
@include('admin.partials.sidebar')
@section('content')

    <div class="col-xl-12 col-lg-12">

        <div class="card">
            <div class="card-header">
                {{ Breadcrumbs::render('employees') }}
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
                            <form action="{{route('search.employees')}}" method="get">
                                <a  class="btn btn-rounded btn-outline-info"  style=" margin-top: 4em;margin-right: 2em  " href="{{route('employees.create')}}" >
                                    <i class="fa fa-plus"></i>
                                    <i  style="font-family:iransans-normal"> ایجاد پرسنل جدید</i>
                                </a>
                                <div class="input-group search-area form-control input-rounded" id="example5_filter" style="border-color:lightgrey;  float: left;height: 49px ;margin-left: 1em ;margin-right: 2em  ;margin-bottom: 1em ;margin-top: 3em "  class="dataTables_filter">
                                    <input type="text"  name="search" class="form-control d-xl-inline-flex d-none" style=" border-color: transparent" placeholder=" جستجو ">
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
                            <th class="text-center align-middle">نام</th>
                            <th class="text-center align-middle">نام خانوادگی</th>
                            <th class="text-center align-middle">کد ملی</th>
                            <th class="text-center align-middle">شماره شناسنامه</th>
                            <th class="text-center align-middle">تعداد فرزند</th>
                            <th class="text-center align-middle">شرکت </th>
                            <th class="text-center align-middle">سمت</th>
                            <th class="text-center align-middle">فعال</th>
                            <th class="text-center align-middle">تاریخ ایجاد</th>
                            <th class="text-center align-middle">تاریخ ویرایش</th>
                            <th class="text-center align-middle">ویرایش</th>
                            <th class="text-center align-middle"> حذف</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)

                            <tr>
                                <td class="text-center align-middle">{{$i++}}</td>
                                <td class="text-center align-middle">{{$employee->employee_id}}</td>
                                <td class="text-center align-middle" > {{($employee->name)}} </td>
                                <td class="text-center align-middle">{{$employee->family}}</td>
                                <td class="text-center align-middle" > {{($employee->national_id)}} </td>
                                <td class="text-center align-middle">{{$employee->certificate_id}}</td>
                                <td class="text-center align-middle" > {{($employee->child)}} </td>

                                <td class="text-center align-middle">{{($employee->company->title)}}</td>
                                <td class="text-center align-middle">{{($employee->position->title)}}</td>
                                @if($employee->status == 0)
                                    <td class="text-center align-middle" name="status"  >غیرفعال</td>
                                @else
                                    <td class="text-center align-middle" name="status"  >فعال</td>
                                @endif
                                <td class="text-center align-middle">{{Hekmatinasser\Verta\Verta::instance( $employee->created_at)->format('%B %d، %Y')}}</td>
                                <td class="text-center align-middle">{{Hekmatinasser\Verta\Verta::instance( $employee->updated_at)->format('%B %d، %Y')}}</td>



                                <td class="text-center align-middle">
                                    <a class=" btn btn-rounded btn-outline-info"
                                       href="{{route('employees.edit',$employee->id)}}">
                                        <i class="fa fa-edit"></i>
                                        <i  style="font-family: iransans-normal"> ویرایش</i>
                                    </a>

                                </td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-rounded btn-outline-danger"
                                            onclick="deleteItem({{$employee->id}})">
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
                            {{$employees->links()}}
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
                title: 'حذف پرسنل',
                text: "آیا از حذف  پرسنل مطمئن هستید؟",
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
                            url: 'http://127.0.0.1:8000/admin/employees/' +id,
                            type: 'delete',
                            dataType: "JSON",
                            data: {
                                _token:"{{csrf_token()}}",
                                "id": id
                            },
                            success: function (response)
                            {
                                if(response===false){
                                    Swal.fire(
                                        'شرکت حذف نشد',
                                        'شرکت مورد نظر در جداول دیگر استفاده شده است',
                                        'باشه'
                                    );
                                }
                                else{

                                    Swal.fire(
                                        'شرکت حذف شد',
                                        'شرکت مورد نظر با موفقیت حذف شد',
                                        'باشه'
                                    );
                                }

                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });

                   // location.reload();
                }
            });
        }
    </script>
@endsection

