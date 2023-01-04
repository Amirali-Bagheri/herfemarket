<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Uploadable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Product\Entities\Product;
use Modules\Product\Repository\ProductRepositoryInterface;

class ProductController extends Controller
{
    use Uploadable;

    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        return view('product::admin.products.index');
    }

    public function create(Request $request)
    {
        return view('product::admin.products.create');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        return view('product::admin.products.update', compact('product'));
    }

    public function deleteMedia($id, $name)
    {
        $product = Product::findOrFail($id);

        $product->images = array_values(array_diff($product->images, [$name]));
        $product->save();

        return redirect()->back();
    }

    public function deletePropertyValue(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->property_values->find($request->property_value_id)->delete();

        return response()->json([
            'success' => true,
            'message' => "ویژگی مورد نظر از محصول حذف شد",
        ]);
    }

    public function storeMedia(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if (!$request->has('images')) {
            $product->save();

            return redirect()->route('admin.products.index')->with('success', 'تصاویر با موفقیت آپلود شد');
        }
        $data = [];

        foreach ($request->file('images') as $image) {
            $basename = $image->getClientOriginalName(); // get the original filename + extension
            $extension = $image->getClientOriginalExtension(); // get the original extension without the dot
            $filename = basename($basename, '.' . $extension); // get the original filename only
            $slug = Str::slug($filename, '-'); // slug the original filename
            $upload_success = $image->move('uploads', $slug . '.' . $extension);
            $full_filename = $slug . '.' . $extension;
            $this->createThumbnail('uploads/' . $full_filename, 256, 256, 'uploads/thumbnails/tn_' . $full_filename);
            array_push($data, $full_filename);
        }
        $product->images = array_merge($data, $product->images);



        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'تصاویر با موفقیت آپلود شد');
    }

    public function destroy($id): void
    {
        $this->productRepository->deleteFull($id);
    }
}
