<span
    @if (!empty($category_url) and ($parent->releatedWith($category_url->id) or $category_url->id == $parent->id))
    class="caret caret-down"
    @else
    class="caret"
    @endif

>
    <i class="fa-regular fa-angle-down "></i>
    {{ $parent->title }}
</span>

<ul
    @if (!empty($category_url) and ($parent->releatedWith($category_url->id) or $category_url->id == $parent->id))
    class="nested active"
    @else
    class="nested"
    @endif
>
    @if(!empty($categories))

        {{--    {{ $parent->children()->whereIn('id',$categories->pluck('id')->toArray())->count() }}--}}
        @foreach($parent->children()->whereIn('id',$categories->pluck('id')->toArray())->get() as $item)
            @php
                $final_url = route('site.products',$item->slug);

                if (!empty($brand)) {
                    $final_url = route('site.products',['url'=>$item->slug,'brand_slug'=>$brand->slug]);
                }

                $queries = [];

                if (!empty($search)) {
                    $queries['search'] = $search;
                }

                if (!empty($brands_filter)) {
                    foreach ($brands_filter as $key => $value){
                        $queries['brands_filter['.$key.']'] = $value;
                    }
                }

                $final_url .= '?' . http_build_query($queries)

            @endphp

            {{--            {{ $item->children()->whereIn('id',$categories->pluck('id')->toArray())->count() }}--}}
            <li>
                @if ($item->parent_id == $parent->id)
                    {{--                @if ($item->children()->whereIn('id',$categories->pluck('id')->toArray())->count() > 0)--}}
                    {{--                    @include('product::site.layouts.categories_sidebar_nested',[ 'category_url'=>$category_url,'parent'=>$item , 'categories'=>$categories,'brand'=>$brand ?? null])--}}
                    {{--                @else--}}
                    <a href="{{$final_url}}">
                        <i class="fa-regular fa-angle-down "></i>

                        {{ $item->title }}
                    </a>
                    {{--                @endif--}}

                @else
                    {{--                @if ($item->children()->whereIn('id',$categories->pluck('id')->toArray())->count() > 0)--}}
                    <a href="{{$final_url}}">
                        <i class="fa-regular fa-angle-down "></i>

                        {{ $item->title }}
                    </a>
                    {{--                @endif--}}
                @endif
            </li>
            {{--        @else--}}
            {{--            {{ $item->children()->whereIn('id',$categories->pluck('id')->toArray())->count() }}--}}
            {{--        @endif--}}




        @endforeach
    @endif
</ul>
