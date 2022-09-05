<?php

namespace Modules\Blog\Http\Livewire\Site;

use Modules\Blog\Entities\Post;
use Modules\Core\Http\Livewire\BaseComponent;

class ListPosts extends BaseComponent
{
    public function render()
    {
        $posts = Post::where('status', 1)->paginate(10);

        return view('blog::site.blog', [
            'posts' => $posts,
        ])->extends('site.layouts.master', [
            'pageTitle' => 'بلاگ',
        ]);
    }
}
