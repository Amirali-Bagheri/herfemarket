@extends('admin.layouts.master')

@section('pageTitle','مدیریت افزونه ها')

@section('content')

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <button class="btn btn-primary shadow-md mr-2">افزودن</button>
        <div class="dropdown">
            <button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300">
                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4"
                                                                           data-feather="plus"></i> </span>
            </button>
            <div class="dropdown-menu w-40">
                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                    <a href="side-menu-light-crud-data-list.html"
                       class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <i data-feather="printer" class="w-4 h-4 mr-2"></i> پرینت </a>
                    <a href="side-menu-light-crud-data-list.html"
                       class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <i data-feather="file-text" class="w-4 h-4 mr-2"></i> خروجی اکسل </a>
                    <a href="side-menu-light-crud-data-list.html"
                       class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <i data-feather="file-text" class="w-4 h-4 mr-2"></i> خروجی PDF </a>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:mr-auto md:ml-0">
            <div class="w-56 relative text-gray-700 dark:text-gray-300">
                <input name="q" type="text" class="form-control w-56 box pr-10 placeholder-theme-13"
                       placeholder="جستجو...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
        </div>
    </div>

    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table text-right table-report -mt-2">
            <thead>

            <tr>
                <th class="text-center whitespace-no-wrap">شناسه</th>
                <th class="text-center whitespace-no-wrap">عنوان</th>
                <th class="text-center whitespace-no-wrap">وضعیت</th>
                <th class="text-center whitespace-no-wrap">گزینه ها</th>
            </tr>

            </thead>
            <tbody>
            @forelse($plugins as $key => $value)
                <tr class="intro-x">
                    <td class="text-center w-20">
                        {{ ($plugins ->currentpage()-1) * $plugins ->perpage() + $loop->index + 1 }}
                    </td>

                    <td class="text-center ">
                        <a href="side-menu-light-crud-data-list.html" class="font-medium whitespace-no-wrap">
                            {{ $value }}
                        </a>
                    </td>
                    <td class="text-center w-40">
                        @if (\Nwidart\Modules\Facades\Module::collections()->has((string)$value))
                            <div class="flex items-center justify-center text-theme-9">
                                <i data-feather="check-square" class="w-4 h-4 mr-2"></i>
                                فعال
                            </div>
                        @else
                            <div class="flex items-center justify-center text-theme-6">
                                <i data-feather="x-square" class="w-4 h-4 mr-2"></i>
                                غیرفعال
                            </div>
                        @endif


                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3 ml-3" href="javascript:void(0)" data-toggle="modal"
                               data-target="#update-modal-{{$value}}">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                ویرایش
                            </a>


                            <a class="flex items-center text-theme-6" href="javascript:void(0)" data-toggle="modal"
                               data-target="#delete-confirmation-modal-{{$value}}">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                حذف
                            </a>
                        </div>


                        <div class="modal" id="delete-confirmation-modal-{{$value}}">
                            <div class="modal-dialog">
                                <div class="p-5 text-center">
                                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                    <div class="text-3xl mt-5">تایید حذف</div>
                                    <div class="text-gray-600 mt-2">آیا اطمینان دارید که مورد انتخاب شده حذف گردد؟
                                    </div>
                                </div>
                                <form action="{{ route('admin.plugins.delete',$value) }}" method="post">
                                    @csrf
                                    <div class="px-5 pb-8 text-center">
                                        <button type="button" data-dismiss="modal"
                                                class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">خروج
                                        </button>
                                        <button type="submit" class="btn w-24 bg-theme-6 text-white">
                                            حذف
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal" id="update-modal-{{$value}}">

                            <div class="modal-dialog">
                                <div class="p-5 text-center">
                                    <i data-feather="info" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
                                    <div class="text-2xl mt-5">وضعیت افزونه</div>
                                    <div class="text-gray-600 mt-2">

                                    </div>
                                </div>
                                <form action="{{ route('admin.plugins.update',$value) }}" method="post">
                                    @csrf
                                    <div class="px-5 pb-8 text-center">
                                        <button type="button" data-dismiss="modal"
                                                class="btn btn-danger w-24 border text-white-700 mr-1 ml-2">خروج
                                        </button>
                                        <button type="submit" class="btn w-24 bg-theme-6 text-white">
                                            @if (\Nwidart\Modules\Facades\Module::collections()->has((string)$value))
                                                غیرفعال

                                            @else
                                                فعال

                                            @endif

                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </td>
                </tr>
            @empty

            @endforelse
            </tbody>
        </table>
    </div>


    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
        <ul class="pagination">
            {{ $plugins->links('admin.layouts.pagination') }}

            {{--            <li>--}}
            {{--                <a class="pagination__link" href="side-menu-light-crud-data-list.html"> <i class="w-4 h-4"--}}
            {{--                                                                                           data-feather="chevrons-left"></i>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li>--}}
            {{--                <a class="pagination__link" href="side-menu-light-crud-data-list.html"> <i class="w-4 h-4"--}}
            {{--                                                                                           data-feather="chevron-left"></i>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li><a class="pagination__link" href="side-menu-light-crud-data-list.html">...</a></li>--}}
            {{--            <li><a class="pagination__link" href="side-menu-light-crud-data-list.html">1</a></li>--}}
            {{--            <li><a class="pagination__link pagination__link--active"--}}
            {{--                   href="side-menu-light-crud-data-list.html">2</a>--}}
            {{--            </li>--}}
            {{--            <li><a class="pagination__link" href="side-menu-light-crud-data-list.html">3</a></li>--}}
            {{--            <li><a class="pagination__link" href="side-menu-light-crud-data-list.html">...</a></li>--}}
            {{--            <li>--}}
            {{--                <a class="pagination__link" href="side-menu-light-crud-data-list.html"> <i class="w-4 h-4"--}}
            {{--                                                                                           data-feather="chevron-right"></i>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li>--}}
            {{--                <a class="pagination__link" href="side-menu-light-crud-data-list.html"> <i class="w-4 h-4"--}}
            {{--                                                                                           data-feather="chevrons-right"></i>--}}
            {{--                </a>--}}
            {{--            </li>--}}
        </ul>
    </div>

@endsection
