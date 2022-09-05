@extends('admin.layouts.master')
@section('pageTitle','مشاهده دسته بندی')

@section('content')

    <blog-categories inline-template>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">اطلاعات دسته بندی: {{$category->title}}</h3>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">زیردسته های این دسته بندی:</h3>

                    </div>
                    <div class="card-body  table-responsive">

                        <table class="table table-hover">
                            <tr>
                                <th>شناسه</th>
                                <th>عنوان دسته بندی</th>
                                <th>نام نمایشی</th>
                                <th>وضعیت</th>
                                <th>زمان ارسال/ویرایش</th>
                                <th>گزینه ها</th>
                            </tr>

                            @if($children && count($children) > 0)
                                @foreach($children as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->title}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td class="text-center">
                                            @if ($category->status == 1)
                                                <span class="badge badge-success">فعال</span>
                                            @else
                                                <span class="badge badge-danger">غیر فعال</span>
                                            @endif
                                        </td>
                                        <td>{{verta($category->updated_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>
                                        <td>
                                            <a title="جزئیات" style="margin: 5px;"
                                               href="{{route('admin.categories.show',$category->slug)}}"
                                               target="_blank">
                                                <i class="fa-regular fa-eye"></i></a>
                                            <a style="margin: 5px;"
                                               title="ویرایش"
                                               href="{{route('admin.categories.update',$category->id)}}">
                                                <i class="fa fa-edit"></i></a>
                                            <a
                                                title="حذف"
                                                style="margin: 5px;"
                                                href="{{route('admin.categories.delete',$category->id)}}">
                                                <i class="fa fa-trash-alt"></i></a>
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" align="center">این دسته بندی زیر دسته ای برای نمایش وجود ندارد</td>
                                </tr>

                            @endif

                        </table>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">محصولات متعلق به این دسته بندی:</h3>

                    </div>
                    <div class="card-body  table-responsive">

                        <table class="table table-hover">
                            <tr>
                                <th>شناسه</th>
                                <th>تصویر</th>
                                <th>عنوان محصول</th>
                                <th>زمان ارسال/ویرایش</th>

                            </tr>

                            @foreach($products as $product)

                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>
                                        <a href="/uploads/{{$product->images[0]}}">
                                            <img class="img-fluid mb-3" width="64px" height="64px"
                                                 src="/uploads/{{$product->images[0]}}"
                                            >
                                        </a>
                                    </td>
                                    <td><a class="text-decoration-none" style="color: #000"
                                           href="{{route('admin.products.show',$product->slug)}}">{{$product->title}}</a>
                                    </td>
                                    <td>{{verta($product->updated_at)->timezone('Asia/Tehran')->format('H:i %B %d، %Y')}}</td>

                                </tr>

                            @endforeach

                        </table>

                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>

    </blog-categories>


@endsection
