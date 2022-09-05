<?php

namespace Modules\Page\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Page\Entities\Page;

class Update extends BaseComponent
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $body;
    public $language;
    public $keywords;
    public $status;
    public Page $page;

    public function mount($id)
    {
        $page = Page::find($id);
        $this->page = $page;
        $this->title = $page->title;
        $this->slug = $page->slug;
        $this->body = html_entity_decode($page->content);
        $this->language = $page->language;
        $this->keywords = $page->keywords;
        $this->status = $page->status;
    }

    public function submit()
    {
        $this->validate([
            'title' => 'required|max:191',
            'body' => 'required',
        ]);

        $this->page->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->body,
            'status' => $this->status,
            'language' => $this->language,
            'keywords' => $this->keywords,
            'modified_by' => Auth::id(),
        ]);

        $this->alert('success', 'انجام شد', [
            'position' => 'bottom-start',
            'timer' => 3000,
            'toast' => true,
            'text' => 'عملیات با موفقیت انجام شد',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        return view('page::admin.create', [

        ])->extends('admin.layouts.master', ['pageTitle' => 'ویرایش صفحه ' . $this->page->title]);
    }
}
