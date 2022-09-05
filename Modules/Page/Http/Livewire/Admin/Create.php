<?php

namespace Modules\Page\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Page\Entities\Page;

class Create extends BaseComponent
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $body;
    public $language;
    public $keywords;
    public $status = true;
    protected $rules = [
        'title' => 'required|max:191',
    ];

    public function submit(): void
    {
        $this->validate();

        $page = Page::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->body,
            'status' => $this->status,
            'language' => $this->language,
            'keywords' => $this->keywords,
            'created_by' => Auth::id(),
        ]);

        $page->save();
        $this->resetInput();

        $this->dispatchBrowserEvent('success', [
            'title' => 'عملیات با موفقیت انجام شد',
            'timer' => 1500,
            'type' => 'success',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center',
        ]);
    }

    private function resetInput()
    {
        $this->title = null;
        $this->slug = null;
        $this->body = null;
        $this->status = true;
    }

    public function render()
    {
        return view('page::admin.create', [
        ])->extends('admin.layouts.master', ['pageTitle' => 'ثبت صفحه']);
    }
}
