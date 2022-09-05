<?php

namespace Modules\Brand\Http\Livewire\Admin;

use Modules\Brand\Entities\Brand;
use Modules\Core\Http\Livewire\BaseComponent;

class Show extends BaseComponent
{
    public $brand;

    public function mount($id)
    {
        $this->brand = Brand::find($id);
    }

    public function render()
    {
        return view('brand::livewire.admin.show')->extends('admin.layouts.master', [
            'pageTitle' => 'برندها'
        ]);
    }
}
