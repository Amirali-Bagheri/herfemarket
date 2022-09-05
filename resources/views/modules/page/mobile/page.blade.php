<div>
    @livewire('site.layouts.sidebar')

    <div class="container">
        <div class="privacy-policy-wrapper pt-3 py-3">
            <h6 class="font-weight-bold text-center justify-content-center mt-3">
                {{$page->title}}
            </h6>
            <hr>
            <p style="padding:10px; line-height:2;">
                {!! html_entity_decode($page->content) !!}
            </p>
        </div>
    </div>

</div>
