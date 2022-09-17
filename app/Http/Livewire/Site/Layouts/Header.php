<?php

namespace App\Http\Livewire\Site\Layouts;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\Layouts\HeaderTrait;

class Header extends BaseComponent
{
    use HeaderTrait;

    public $q;

    public function search()
    {

    }
    public function render()
    {
        return view('site.layouts.header');
    }
}
