<?php

namespace Modules\Blog\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Entities\Post;
use Modules\Blog\Repositories\PostRepositoryInterface;
use Modules\Seo\Facades\Meta;
use Modules\Seo\Packages\Entities\OpenGraphPackage;
use Modules\Seo\Packages\Entities\TwitterCardPackage;
use Modules\Setting\Entities\Setting;

class PostsController extends Controller
{
    private $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $posts = Post::where('status', 1)->paginate(10);
        Meta::setTitleSeparator('-')->setTitle('بلاگ')->prependTitle(Setting::get('seo_meta_title'));

        return view('site.blog', [
            'posts' => $posts,
            'pageTitle' => 'بلاگ'
        ]);
    }

    public function show(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();


//        $post = $this->repository->getPostBySlug($slug);

        if ($post and $post->status != 1) {
            abort(404);
        }

        $visit = new_visit($post, []);
        //        visits($post)->seconds(60)->increment();

        // $comments = $post->comments;

        $og = new OpenGraphPackage('og_product');
        $twitter = new TwitterCardPackage('twitter_product');

        $og->setType('website')
            ->setSiteName(Setting::get('seo_meta_title'))
            ->setTitle($post->title)
            ->setDescription($post->title)
            ->setLocale('fa_IR')
            ->addImage(route('site.index') . '/uploads/' . $post->image)
            ->setUrl(route('site.blog.single', $post->slug));

        $twitter->setType('summary')
            ->setSite('@' . Setting::get('social_twitter'))
            ->setTitle($post->title)
            ->setDescription($post->title)
            ->setImage(route('site.index') . '/uploads/' . $post->image);

        Meta::registerPackage($og);
        Meta::registerPackage($twitter);
        Meta::setMetaFrom($post);

        return view('site.blog_single', [
            'post' => $post,
            'pageTitle' => 'بلاگ'
        ]);
    }

    public function search(Request $request)
    {
        $q = $request->q;

        $posts = Post::search($q)->paginate(10);

        return view('site.blog', compact('posts'));
    }

    public function category(Request $request, $slug)
    {
        $category = BlogCategory::firstWhere('slug', $slug);

        visits($category)->seconds(60)->increment();

        $posts = $category->posts()->where('status', 1)->paginate(20);

        return view('site.blog', compact('posts'));
    }

    public function categories(Request $request)
    {
        return abort(404);
    }
}
