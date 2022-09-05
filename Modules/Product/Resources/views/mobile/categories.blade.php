<div>
    @include('mobile.layouts.sidebar')

    <div class="container-fluid text-center justify-content-center mb-4 pt-3">
        <div class="card discount-coupon-card border-0 text-center justify-content-center">
            <div class="card-body text-center justify-content-center">
                @livewire('site-search')
            </div>
        </div>
    </div>
    <div class="product-catagories-wrapper py-3">
        <div class="container-fluid">
            <div class="section-heading">
                <h6 class="text-center ml-1">دسته بندی ها</h6>
                <br>
            </div>
            <div class="product-catagory-wrap">
                <div class="row g-3">
                    @foreach($categories as $category)
                        <div class="col-6">
                            <div class="card catagory-card">
                                <div class="card-body">
                                    <a class="text-danger" href="{{route('site.products',$category->slug)}}">
                                        <img src="/uploads/{{$category->image}}" width="65px">
                                        <p class="font-weight-bold color-black mt-2">{{$category->title}}</p>
{{--                                        <span style="padding:10px;">{{$category->products_count}} مورد</span>--}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
