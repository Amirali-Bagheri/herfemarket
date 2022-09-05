<?php

namespace Modules\Blog\Http\Livewire\Site\Layouts;

use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Entities\Post;
use Modules\Core\Http\Livewire\BaseComponent;

class Sidebar extends BaseComponent
{
    public function render()
    {
        return view('blog::livewire.site.layouts.sidebar', [
            'latestPosts' => Post::where('status', 1)->latest()->take(4)->get(),
            'postsCategories' => BlogCategory::whereHas('posts')->withCount('posts')->where('status', 1)
                ->orderBy('posts_count', 'asc')->take(8)->get(),
        ]);
    }
}
