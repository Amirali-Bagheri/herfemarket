<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Exports\PostsExport;
use App\Http\Controllers\Controller;
use App\Imports\PostsImport;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Entities\Post;
use Modules\Blog\Repositories\PostRepositoryInterface;
use Modules\Seo\MetaTags\Entities\Tag;

class PostsController extends Controller
{
    use Uploadable;

    private $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $categories = BlogCategory::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');
            $tags = Tag::all();

            return view('blog::create', compact('categories', 'tags'));
        }

        $validation = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'description' => 'required',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request['content'],
            'slug' => $request->slug,
            'status' => $request->status,
            'comment_status' => $request->comment_status,
        ]);

        if ($request->has('image')) {
            $image = $request->file('image');

            $basename = $image->getClientOriginalName(); // get the original filename + extension
            $extension = $image->getClientOriginalExtension(); // get the original extension without the dot
            $filename = basename($basename, '.' . $extension); // get the original filename only
            $slug = Str::slug($filename, '-'); // slug the original filename
            $upload_success = $image->move('uploads', $slug . '.' . $extension);
            $full_filename = $slug . '.' . $extension;
            $post->image = $full_filename;

            $this->createThumbnail('uploads/' . $full_filename, 150, 93, 'uploads/thumbnails/tn_small_' . $full_filename);
            $this->createThumbnail('uploads/' . $full_filename, 300, 185, 'uploads/thumbnails/tn_medium_' . $full_filename);
            $this->createThumbnail('uploads/' . $full_filename, 550, 340, 'uploads/thumbnails/tn_large_' . $full_filename);
        }

        if ($request->has('categories')) {
            $post->categories()->sync($request['categories']);
        }

        if ($request->has('tags')) {
            $post->tags = implode(',', $request->tags);
        }

        $post->save();

        return redirect()->route('admin.posts.index', compact('post'))->with('success', 'پست مورد نظر با موفقیت ثبت شد.');
    }

    public function show(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('admin.posts.index')->withError($exception->getMessage())->withInput();
        }

        $comments = $post->comments;

        return view('blog::show', compact('post', 'comments'));
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            try {
                $post = Post::findOrFail($id);
            } catch (ModelNotFoundException $exception) {
                return redirect()->route('admin.posts.index')->withError($exception->getMessage())->withInput();
            }
            $categories = BlogCategory::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');
            $tags = Tag::all();

            return view('blog::update', compact('categories', 'post', 'tags'));
        }

        $post = Post::findOrFail($id);

        $validation = Validator::make($request->all(), [
            'title' => 'bail|required|max:255',
            'content' => 'required',
            'description' => 'required',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request['content'],
            'slug' => $request->slug,
            'status' => $request->status,
            'comment_status' => $request->comment_status,
        ]);

        if ($request->has('image')) {
            $image = $request->file('image');

            $basename = $image->getClientOriginalName(); // get the original filename + extension
            $extension = $image->getClientOriginalExtension(); // get the original extension without the dot
            $filename = basename($basename, '.' . $extension); // get the original filename only
            $slug = Str::slug($filename, '-'); // slug the original filename
            $upload_success = $image->move('uploads', $slug . '.' . $extension);
            $full_filename = $slug . '.' . $extension;
            $post->image = $full_filename;

            $this->createThumbnail('uploads/' . $full_filename, 150, 93, 'uploads/thumbnails/tn_small_' . $full_filename);
            $this->createThumbnail('uploads/' . $full_filename, 300, 185, 'uploads/thumbnails/tn_medium_' . $full_filename);
            $this->createThumbnail('uploads/' . $full_filename, 550, 340, 'uploads/thumbnails/tn_large_' . $full_filename);
        }

        if ($request->has('categories')) {
            $post->categories()->sync($request['categories']);
        }

        if ($request->has('tags')) {
            $post->tags = implode(',', $request->tags);
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with(['success' => 'ویرایش با موفقیت انجام شد']);
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('admin.posts.index')->withError($exception->getMessage())->withInput();
        }

        $post->delete();

        return redirect()->route('admin.posts.index', compact('post'))->with('success', 'پست مورد نظر با موفقیت حذف گردید.');
    }

    public function export()
    {
        return Excel::download(new PostsExport(), date('Ymd') . '_posts.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new PostsImport(), request()->file('excel'));

        return back()->with('success', 'اطلاعات با موفقیت ثبت شد');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        Post::whereIn('id', explode(",", $ids))->delete();

        return response()->json([
            'status' => true,
            'message' => "اطلاعات مورد نظر با موفقیت حذف گردید.",
        ]);
    }

    public function search(Request $request)
    {
        $posts = Post::where('title', 'LIKE', "%{$request->input('s')}%")
            ->orWhere('content', 'LIKE', "%{$request->input('s')}%")
            ->paginate(10);

        return view('blog::index', compact('posts'));
    }
}
