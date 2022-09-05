<?php

namespace Modules\Comments\Http\Livewire\Admin;

use Modules\Core\Http\Livewire\BaseComponent;

class Create extends BaseComponent
{
    public function render()
    {
        return view('comments::livewire.admin.create');
    }
}
