<?php

namespace Modules\Brand\Http\Controllers\Admin;

use App\Exports\BrandsExport;
use App\Http\Controllers\Controller;
use App\Imports\BrandsImport;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;

class BrandController extends Controller
{
    public function index()
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/brands')
         * @name('brands.index')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        $brands = Brand::paginate(20);

        return view('brand::admin.index', compact('brands'));
    }

    public function create(Request $request)
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/brands/create')
         * @name('brands.create')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        if ($request->isMethod('get')) {
            $categories = Category::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');
            return view('brand::admin.create', compact('categories'));
        }

        $validation = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'image' => 'mimes:jpg,jpeg,png|max:1000',
            'categories' => 'required',

        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $brand = Brand::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'description' => $request['description'],
            'status' => $request['status'],
        ]);


        if ($request->has('categories')) {
            $brand->categories()->sync($request['categories']);
            foreach ($request->categories as $categoryID) {
                $category = Category::find($categoryID);
                $brand->categories()->sync($category->id);
                $brand->categories()->attach($category->children->pluck('id'));
            }
        }

        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $brand->image = $imageName;
            $request->image->storeAs('uploads', $imageName);
        }

        $brand->save();

        if ($brand) {
            return redirect()->back()->with(['success' => 'برند مورد نظر با موفقیت ایجاد شد.']);
        }
    }

    public function search(Request $request)
    {
        /**
         * @get('/admin/categories/search')
         * @name('categories.search')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        $brands = Brand::where('title', 'LIKE', "%{$request->input('s')}%")->paginate(10);

        return view('brand::admin.index', compact('brands'));
    }

    public function update(Request $request, $id)
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/brands/update/{id}')
         * @name('brands.update')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        if ($request->isMethod('get')) {
            try {
                $brand = Brand::findOrFail($id);
            } catch (ModelNotFoundException $exception) {
                return redirect()->route('admin.brands.index')->withError($exception->getMessage())->withInput();
            }
            $categories = Category::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');
            return view('brand::admin.update', compact('brand', 'categories'));
        }
        $brand = Brand::findOrFail($id);

        $validation = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'categories' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:1000',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $brand->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'slug' => $request['slug'],
            'status' => $request['status'],
        ]);

        // return  Category::whereIn('id', $request->categories)->with(['children' => function ($q) {
        //     $q->children;
        // }])->get()->pluck('id');

        if ($request->has('categories')) {
            $array = collect([]);

            foreach ($request->categories as $categoryID) {
                $category = Category::find($categoryID);
                $merged = $array->merge($category->children);
            }
//            return $merged;
            $brand->categories()->sync($request['categories']);
            Category::whereIn('id', $merged->pluck('children.*.id', 'id')->collapse()->unique())->get();
            foreach (Category::whereIn('id', $merged->pluck('children.*.id', 'id')->collapse()->unique())->get() as $category) {
                $brand->categories()->attach($category->id);
            }
        }


        //  if ($request->has('categories')) {
        //     $brand->categories()->sync($request['categories']);
        //     foreach ($request->categories as $categoryID) {
        //         $category = Category::find($categoryID);
        //         $brand->categories()->sync($category->id);
        //         $brand->categories()->attach($category->children()->with(['children' => function ($q) {
        //             $q->with(['children' => function ($q) {
        //                 $q->with(['children' => function ($q) {
        //                     $q->with('children');
        //                 }]);
        //             }]);
        //         }])->pluck('id'));
        //     }
        // }

        if ($request->has('image')) {
            $image = $request->file('image');
            $basename = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $filename = basename($basename, '.' . $extension);
            $slug = Str::slug($filename, '-');
            $upload_success = $image->move('uploads/brands', $slug . '.' . $extension);
            $full_filename = $slug . '.' . $extension;
            $brand->image = $full_filename;
        }

        $brand->save();

        if ($brand) {
            return redirect()->route('admin.brands.index')->with('success', 'برند مورد نظر با موفقیت ویرایش شد.');
        }
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        if (!$brand) {
            return;
        }
        return redirect()->route('admin.brands.index', compact('brand'))->with('success', 'برند مورد نظر با موفقیت حذف گردید.');
    }

    public function import(Request $request)
    {
        Excel::import(new BrandsImport(), request()->file('excel'));

        return back()->with('success', 'اطلاعات با موفقیت ثبت شد');
    }

    public function export()
    {
        return Excel::download(new BrandsExport(), date('Ymd') . '_brands.xlsx');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        Brand::whereIn('id', explode(",", $ids))->delete();

        return response()->json([
            'status' => true,
            'message' => "برند های مورد نظر با موفقیت حذف گردید.",
        ]);
    }
}
