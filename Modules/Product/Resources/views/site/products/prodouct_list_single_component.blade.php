<div class="wt-listing-container col-xl-6 col-md-6 col-lg-6 col-sm-6 col-12" wire:ignore.self
     wire:key="{{$product->id}}">
    <div class="list-item-container m-b20 clearfix"
         style="border-radius: 5px; min-height: 245px; max-height: 245px;">
        <div class="list-image-box bg-cover bg-no-repeat col-6 float-right">
            <a class="text-decoration-none"
               href="{{ isset($product->slug) ? route('site.products.single',$product->slug ) : '#' }}">
                <img loading="lazy"
                     style="max-height: 220px; height:auto; padding: 5px;"
                     class="img-fluid"
                     src="{{ isset($product->thumbnail_url) ? $product->thumbnail_url : '/uploads/product.png' }}"
                     alt="{{ $product->title }}">
            </a>

        </div>
        <div class="list-category-content col-6 float-left"
             style="min-height: inherit;padding: 0 5px 0 5px; position: relative;">
            <a class="text-decoration-none"
               href="{{ isset($product->slug) ? route('site.products.single',$product->slug ) : '#' }}">

                <p class="listing-place-name rtl text-right" title="{{$product->title}}"
                   style="font-size: 14px; display: inline-block;">
                    {{ Str::limit($product->title,50) }}
                </p>
            </a>
            {{-- <div class="wt-rating-section" style="font-size: 12px;">

                {!! html_entity_decode($product->ratingBlade()) !!}
                </span>
                <span class="wt-rating-conting">
                    ( {{ $product->ratingCount() }})
            </span>
        </div> --}}
            <br>
            <div class="text-center pt-1 justify-content-center">

                @if($product->prices()->count() > 0)
                    @if ($product->max_price > 0)
                        <span style="font-size: 13px;" class="listing-cat-address">قیمت

                            @if ($product->min_price == $product->max_price)
                                {{ number_format($product->min_price) }}
                            @else
                                از
                                <span
                                    style="color: #8BC34A;">{{ number_format($product->min_price ?? 0) }}</span>
                                تا
                                <span
                                    style="color:#ff1744; ">{{ number_format($product->max_price ?? 0) }}</span>
                            @endif
                                        تومان</span>
                    @else
                        <span class="listing-cat-address">ناموجود</span>

                    @endif

                @else
                    <span class="listing-cat-address">بدون قیمت</span>

                @endif

                <div style="position: absolute; bottom: 8px; margin-left: 0; margin-right: 0; left: 0; right: 0;">
                    @if($product->has_prices_with_stock and $product->max_price != 0 and isset($product->best_price))
                        <p style="color: #8BC34A; font-size: 13px;">بهترین
                            قیمت در
                            <b style="color: #8BC34A;">{{ $product->best_price }}</b>
                        </p>
                    @endif
                    <a href="{{ route('site.products.single',$product->slug) }}">
                                            <span
                                                style="font-size: 12px; border-radius: 20px; background-color: #ff1744 !important;"
                                                class="list-cat-verified "><i class="fas fa-list"></i>
                                                فهرست
                                                فروشندگان </span>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
