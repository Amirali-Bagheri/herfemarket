<?php

namespace Modules\Blog\Http\Livewire\Site;

use Modules\Core\Http\Livewire\BaseComponent;

class Categories extends BaseComponent
{
    public function render()
    {
        return view('blog::livewire.site.categories');
    }
}
