<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Blog\Entities\BlogCategory;

class CategoryController extends Controller
{
    use Uploadable;

    public function deleteAll()
    {
    }

    public function export()
    {
    }

    public function destroy()
    {
    }

    public function import()
    {
    }

    public function search()
    {
    }

    public function index()
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/categories')
         * @name('categories.index')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        $categories = BlogCategory::paginate(20);

        return view('blog::admin.categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/categories/create')
         * @name('categories.create')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        if ($request->isMethod('get')) {
            $categories = BlogCategory::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');

            return view('blog::admin.categories.create', compact('categories'));
        }

        $validation = Validator::make($request->all(), [
            'title' => 'required|max:191',
            //            'parent_id' =>  'required|not_in:0',
            'image' => 'mimes:jpg,gif,svg,jpeg,png|max:2048',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $category = BlogCategory::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent_id'],
            'image' => $request['image'],
            'description' => $request['description'],
            'status' => $request['status'],

        ]);

        if ($request->has('image')) {
            $image = $request->file('image');

            $basename = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $imageName = basename($basename, '.' . $extension);
            $slug = Str::slug($imageName, '-');
            $upload_success = $image->move('uploads', $slug . '.' . $extension);

            $category->image = $slug . '.' . $extension;
        }

        if ($request['parent_id'] == null) {
            $category->parent_id = $request['parent_id'] = 0;
        }

        $category->save();

        if (!$category) {
            return;
        }

        return redirect()->route('admin.blog.categories.index')->with(['success' => 'دسته مورد نظر با موفقیت ایجاد شد.']);
    }

    public function update($id, Request $request)
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/categories/update/{id}')
         * @name('categories.update')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        if ($request->isMethod('get')) {
            try {
                $category = BlogCategory::findOrFail($id);
            } catch (ModelNotFoundException $exception) {
                return redirect()->route('admin.blog.categories.index')->withError($exception->getMessage())->withInput();
            }

            $categories = BlogCategory::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');

            return view('blog::admin.categories.update', compact('category', 'categories'));
        }
        $category = BlogCategory::findOrFail($id);

        $validation = Validator::make($request->all(), [
            'title' => 'required|max:191',
            //            'parent_id' =>  'required|not_in:0',
            'image' => 'mimes:jpg,gif,svg,jpeg,png|max:2048',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $category->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent_id'],
            'description' => $request['description'],
            'status' => $request['status'],
        ]);

        if ($request->has('image')) {
            $image = $request->file('image');

            $basename = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $imageName = basename($basename, '.' . $extension);
            $slug = Str::slug($imageName, '-');
            $upload_success = $image->move('uploads', $slug . '.' . $extension);

            $category->image = $slug . '.' . $extension;
        }

        if ($request['parent_id'] == null) {
            $category->parent_id = $request['parent_id'] = 0;
        }

        $category->save();
        if (!$category) {
            return;
        }

        return redirect()->route('admin.blog.categories.index', compact('category'))
            ->with('success', 'دسته بندی مورد نظر با موفقیت ویرایش شد.');
    }

    public function show(Request $request, $slug)
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/categories/show/{slug}')
         * @name('categories.show')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        $category = BlogCategory::firstWhere('slug', $slug);

        $categories = BlogCategory::all();

        $products = $category->products;

        $children = $category->children;

        return view('blog::admin.categories.show', compact('category', 'categories', 'products', 'children'));
    }

    public function delete($id)
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/categories/delete/{id}')
         * @name('categories.delete')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        $category = BlogCategory::findOrFail($id);
        if ($category->products) {
            foreach ($category->products as $product) {
                $product->categories()->sync(1); // Sync to Without Category
            }
        }

        $category->delete();
        if (!$category) {
            return;
        }

        return redirect()->route('admin.blog.categories.index', compact('category'))
            ->with('success', 'دسته بندی مورد نظر با موفقیت حذف گردید.');
    }
}
