<?php

namespace Modules\Comments\Http\Livewire\Admin;

use Modules\Comments\Entities\Comment;
use Modules\Core\Http\Livewire\BaseComponent;

class Update extends BaseComponent
{
    public $comment;
    public $body;
    public $status;

    public function mount($id)
    {
        $this->comment = Comment::withAnyStatus()->find($id);
        $this->body    = $this->comment->body;
        $this->status  = (bool)$this->comment->status;
    }

    public function submit()
    {
        $this->validate([
            'body' => 'required',
        ]);

        $this->comment->update([
            'body'   => $this->body,
            'status' => $this->status,
        ]);

        $this->alert('success', 'انجام شد', [
            'position'          => 'bottom-start',
            'timer'             => 3000,
            'toast'             => true,
            'text'              => 'عملیات با موفقیت انجام شد',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        return view('comments::admin.update')->extends('admin.layouts.master', [
            'pageTitle' => 'ویرایش دیدگاه',
        ]);
    }
}
