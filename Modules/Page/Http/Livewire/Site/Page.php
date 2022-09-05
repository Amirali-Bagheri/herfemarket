<?php

namespace Modules\Page\Http\Livewire\Site;

use Modules\Core\Http\Livewire\BaseComponent;

class Page extends BaseComponent
{
    public $slug;
    public $page;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $page = \Modules\Page\Entities\Page::firstWhere('slug', $this->slug);
        // Meta::setMetaFrom($page);
        //
        // visits($page)->seconds(60)->increment();

        return view('page::site.page', [
            'page' => $page,
        ])->extends('site.layouts.master');
    }
}
