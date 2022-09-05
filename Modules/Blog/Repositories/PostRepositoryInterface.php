<?php

namespace Modules\Blog\Repositories;

interface PostRepositoryInterface
{
    public function getAll();

    public function getPostById($id);

    public function getPostBySlug($slug);
}
