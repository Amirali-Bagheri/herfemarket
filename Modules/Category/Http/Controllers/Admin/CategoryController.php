<?php

namespace Modules\Category\Http\Controllers\Admin;

use App\Traits\Uploadable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;

class CategoryController extends Controller
{
    use Uploadable;


    public function index()
    {
        return view('category::admin.index');
    }

    public function create(Request $request)
    {
        return view('category::admin.create');
    }

    public function update($id, Request $request)
    {
        $category = Category::findOrFail($id);
        return view('category::admin.update', ['category' => $category]);
    }

//    public function show(Request $request, $slug)
//    {
//        $category = Category::firstWhere('slug', $slug);
//
//        $categories = Category::all();
//
//        $products = $category->products;
//
//        $children = $category->children;
//        return view('category::admin.show', compact('category', 'categories', 'products', 'children'));
//    }

    public function delete($id)
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/categories/delete/{id}')
         * @name('categories.delete')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        $category = Category::findOrFail($id);
        if ($category->products) {
            foreach ($category->products as $product) {
                $product->categories()->sync(1); // Sync to Without Category
            }
        }


        $category->delete();
        if (!$category) {
            return;
        }
        return redirect()->route('admin.categories.index', compact('category'))->with('success', 'دسته بندی مورد نظر با موفقیت حذف گردید.');
    }
}
