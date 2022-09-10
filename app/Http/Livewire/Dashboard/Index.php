<?php

namespace App\Http\Livewire\Dashboard;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\Layouts\HeaderTrait;

class Index extends BaseComponent
{
    use HeaderTrait;

    public function render()
    {
        return view('site.dashboard.index')->extends('site.layouts.master',[
            'pageTitle'=>'داشبورد'
        ]);
    }
}
