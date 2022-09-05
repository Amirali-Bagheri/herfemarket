<?php

namespace Modules\Blog\Http\Livewire\Site;

use Modules\Blog\Entities\BlogCategory;
use Modules\Core\Http\Livewire\BaseComponent;

class Category extends BaseComponent
{
    public $category;

    public function mount($slug)
    {
        $this->category = BlogCategory::firstWhere('slug', $slug);
        if (!$this->category or $this->category->status != 1) {
            abort(404);
        }
    }

    public function render()
    {
        $posts = $this->category->posts()->where('status', 1)->paginate(10);

        return view('blog::site.blog', [
            'posts' => $posts,
        ])->extends('site.layouts.master', [
            'pageTitle' => 'بلاگ',
        ]);
    }
}
