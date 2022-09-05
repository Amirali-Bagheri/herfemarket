<?php

namespace Modules\Blog\Http\Livewire\Site;

use Modules\Blog\Repositories\PostRepository;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Seo\Facades\Meta;
use Modules\Seo\Packages\Entities\OpenGraphPackage;
use Modules\Seo\Packages\Entities\TwitterCardPackage;
use Modules\Setting\Entities\Setting;

class Single extends BaseComponent
{
    public $post;

    public function mount($slug, PostRepository $repository)
    {
        $this->post = $repository->getPostBySlug($slug);
        if ($this->post and $this->post->status != 1) {
            abort(404);
        }
    }

    public function render()
    {
        if ($this->post->title) {
            Meta::setTitleSeparator('-')->setTitle($this->post->title)->prependTitle(Setting::get('seo_meta_title'));
        }

        $visit = new_visit($this->post, []);

        // $comments = $this->post->comments;

        $og = new OpenGraphPackage('og_product');
        $twitter = new TwitterCardPackage('twitter_product');

        $og->setType('website')
            ->setSiteName(Setting::get('seo_meta_title'))
            ->setTitle($this->post->title)
            ->setDescription($this->post->title)
            ->setLocale('fa_IR')
            ->addImage(route('site.index') . '/uploads/' . $this->post->image)
            ->setUrl(route('site.blog.single', $this->post->slug));

        $twitter->setType('summary')
            ->setSite('@' . Setting::get('social_twitter'))
            ->setTitle($this->post->title)
            ->setDescription($this->post->title)
            ->setImage(route('site.index') . '/uploads/' . $this->post->image);

        Meta::registerPackage($og);
        Meta::registerPackage($twitter);
        Meta::setMetaFrom($this->post);

        return view('blog::site.blog_single', [

        ])->extends('site.layouts.master');
    }
}
