<?php

namespace App\Http\Livewire\Admin\Layouts;

use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\Layouts\HeaderTrait;

class Header extends BaseComponent
{
    public $listeners = [
        'refreshComponent' => '$refresh',
        'changeThemeDark'  => 'changeThemeDark',
    ];

    use HeaderTrait;

    public function render()
    {
        return view('admin.layouts.header', [
            //            'notifications' => auth()->user()->unreadNotifications
        ]);
    }
}
