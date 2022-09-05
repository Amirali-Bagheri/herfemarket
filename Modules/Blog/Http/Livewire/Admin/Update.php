<?php

namespace Modules\Blog\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Entities\Post;
use Modules\Core\Http\Livewire\BaseComponent;

class Update extends BaseComponent
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $tags;
    public $categories;
    public $description;
    public $image;
    public $image_url;
    public $body;
    public $comment_status;
    public $keywords;
    public $status;
    public Post $post;
    protected $listeners = ['categoriesSelected'];

    public function categoriesSelected($categoriesValues)
    {
        $this->categories = $categoriesValues;
    }

    public function mount($id)
    {
        $post = Post::find($id);
        $this->post = $post;

        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->image_url = $post->thumbnail_url ?? null;
        // $this->body = $post->content;
        $this->description = $post->description;
        // $this->categories = $post->categories->pluck('id');
        // $this->tags = explode(',',$post->tags);
        // $this->language = $post->language;
        // $this->keywords = $post->keywords;
        $this->status = $post->status;
        $this->comment_status = $post->comment_status;
    }

    public function submit()
    {
        // dd('tear');
        //        dd( $this->body,html_entity_decode($this->body),strip_tags_content($this->body),htmlspecialchars_decode($this->body),json_encode($this->body),json_decode($this->body));
        $this->validate([
            'title' => 'required|max:191',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //        $post = Post::findOrFail($this->post->id);

        $this->post->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->body,
            'status' => $this->status,
            'comment_status' => $this->comment_status,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'tags' => $this->tags,
            'modified_by' => Auth::id(),
        ]);

        if ($this->image) {
            $filename = 'image_' . time() . '.' . $this->image->extension();
            $this->image->storeAs('/uploads', $filename);
            $this->post->images = $filename;
            $this->post->save();
        }

        if ($this->categories) {
            $this->post->categories()->sync($this->categories);
        }

        // if ($this->tags) {
        //     $this->post->tags = implode(',', $this->tags);
        // }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => 3500,
            'toast' => true,
            'text' => '',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
        // $this->redirect(route('admin.posts.index'));
    }

    public function render()
    {
        $categories_list = BlogCategory::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');

        return view('blog::admin.update', [
            'categories_list' => $categories_list ?? [],
        ])->extends('admin.layouts.master', ['pageTitle' => 'ویرایش پست ' . $this->post->title]);
    }
}
