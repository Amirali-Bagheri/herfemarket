<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Exports\PropertiesExport;
use App\Http\Controllers\Controller;
use App\Imports\PropertiesImport;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Property;

class PropertiesController extends Controller
{
    public function index()
    {
        $properties = Property::latest()->paginate(20);

        return view('product::admin.properties.index', compact('properties'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $properties = Property::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');
            $categories = Category::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');

            return view('product::admin.properties.create', compact('properties', 'categories'));
        }

        $validation = Validator::make($request->all(), [
            'title' => 'required|max:191',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $property = Property::create([
            'title' => $request['title'],
            'parent_id' => $request['parent_id'],
        ]);

        if ($request->has('categories')) {
            $property->categories()->sync($request['categories']);
            foreach ($request->categories as $categoryID) {
                $category = Category::find($categoryID);
                $property->categories()->sync($category->id);
                $property->categories()->attach($category->parents->pluck('id'));
            }
        }

        if ($request['parent_id'] == null) {
            $property->parent_id = $request['parent_id'] = 0;
        }

        $property->save();

        if (!$property) {
            return;
        }
        return redirect(route('admin.properties.index'))->with(['success' => 'ویژگی مورد نظر با موفقیت ایجاد شد.']);
    }

    public function update($id, Request $request)
    {
        if ($request->isMethod('get')) {
            try {
                $property = Property::findOrFail($id);
            } catch (ModelNotFoundException $exception) {
                return redirect()->route('admin.properties.index')->withError($exception->getMessage())->withInput();
            }

            $properties = Property::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');
            $categories = Category::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');

            return view('product::admin.properties.update', compact('property', 'properties', 'categories'));
        }
        $property = Property::findOrFail($id);

        $validation = Validator::make($request->all(), [
            'title' => 'required|max:191',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $property->update([
            'title' => $request['title'],
            'parent_id' => $request['parent_id'],
        ]);

        if ($request->has('categories')) {
            $property->categories()->sync($request['categories']);
            foreach ($request->categories as $categoryID) {
                $category = Category::find($categoryID);
                $property->categories()->sync($category->id);
                $property->categories()->attach($category->parents->pluck('id'));
            }
        }

        if ($request['parent_id'] == null) {
            $property->parent_id = $request['parent_id'] = 0;
        }

        $property->save();
        if (!$property) {
            return;
        }
        return redirect()->route('admin.properties.index', compact('property'))->with('success', 'ویژگی مورد نظر با موفقیت ویرایش شد.');
    }

    public function export()
    {
        return Excel::download(new PropertiesExport(), date('Ymd') . '_properties.xlsx');
    }

    public function show(Request $request, $slug)
    {
        $property = Property::firstWhere('slug', $slug);

        $properties = Property::all();

        $products = $property->products;

        return view('product::admin.properties.show', compact('property', 'properties', 'products'));
    }

    public function delete($id)
    {
        $property = Property::findOrFail($id);
        if ($property->products) {
            foreach ($property->products as $product) {
                $product->properties()->sync(1); // Sync to Without Property
            }
        }


        $property->delete();
        if (!$property) {
            return;
        }
        return redirect()->route('admin.properties.index', compact('property'))->with('success', 'ویژگی مورد نظر با موفقیت حذف گردید.');
    }

    public function search(Request $request)
    {
        $properties = Property::where('title', 'LIKE', "%{$request->input('s')}%")->paginate(10);

        return view('product::admin.properties.index', compact('properties'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $property = Property::whereIn('id', explode(",", $ids));


        //        if ($property->products){
        //            foreach ($property->products as $product){
        //                $product->properties()->sync(1); // Sync to Without Property
        //            }
        //        }
        $property->delete();
        return response()->json([
            'status' => true,
            'message' => "ویژگی های مورد نظر با موفقیت حذف گردید.",
        ]);
    }

    /*public function property($slug)
    {
        $property = Property::where('slug', '=', $slug)->first();


        if (is_null($property)) {
            return abort(404);
        }

        $articles = $property->articles();

        return view('site.blog.index', compact('articles'));
    }*/
    public function import(Request $request)
    {
        // return $request->all();
        Excel::import(new PropertiesImport(), $request->file('excel'));

        return back()->with('success', 'اطلاعات با موفقیت ثبت شد');
    }
}
