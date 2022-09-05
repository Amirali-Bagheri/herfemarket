<?php

namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Post;

class PostRepository implements PostRepositoryInterface
{
    public function getAll()
    {
        return Post::all();
    }

    public function getPostById($id)
    {
        return Post::findOrFail($id);
    }

    public function getPostBySlug($slug)
    {
        return Post::firstWhere('slug', $slug);
    }
}
