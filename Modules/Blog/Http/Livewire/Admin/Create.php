<?php

namespace Modules\Blog\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Entities\Post;
use Modules\Core\Http\Livewire\BaseComponent;

class Create extends BaseComponent
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $tags;
    public $categories;
    public $description;
    public $image;
    public $body;
    public $comment_status = true;
    public $keywords;
    public $status = true;
    protected $rules = [
        'title' => 'required|max:191',
        'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    public function submit(): void
    {
        $this->validate();

        $post = Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->body,
            'status' => $this->status,
            'comment_status' => $this->comment_status,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'tags' => $this->tags,
            'created_by' => Auth::id(),
        ]);

        if ($this->image) {
            $filename = 'image_' . time() . '.' . $this->image->extension();
            // $this->image->storeAs(__DIR__ .'/uploads', $filename);
            $this->image->storeAs('/uploads', $filename, 'uploads');

            $post->images = $filename;
            $post->save();
        }
        if ($this->categories) {
            $post->categories()->sync($this->categories);
        }

        // if ($this->tags) {
        //     $post->tags = implode(',', $this->tags);
        // }

        $post->save();

        $this->resetInput();
        $this->flash('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => 3500,
            'toast' => true,
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);

        $this->redirect(route('admin.posts.index'));
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
        $categories_list = BlogCategory::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');

        return view('blog::admin.create', [
            'categories_list' => $categories_list ?? [],
        ])->extends('admin.layouts.master', ['pageTitle' => 'ثبت صفحه']);
    }
}
