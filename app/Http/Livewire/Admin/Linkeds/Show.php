<?php

namespace App\Http\Livewire\Admin\Linkeds;

use App\Models\Linked;
use Modules\Core\Http\Livewire\BaseComponent;

class Show extends BaseComponent
{
    public $linked;

    public function mount($id)
    {
        $this->linked = Linked::query()->find($id);
    }

    public function render()
    {
        dd($this->linked, $this->linked->token, $this->linked->value, $this->linked->access_token, $this->linked->provider_user_id, $this->linked->email);

        return view('livewire.admin.linkeds.datatable', [

        ])->extends('admin.layouts.master', ['pageTitle' => 'رویداد ها']);
    }
}
