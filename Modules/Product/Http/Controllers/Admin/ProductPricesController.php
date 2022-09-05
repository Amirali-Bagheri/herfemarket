<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Entities\ProductPrices;

class ProductPricesController extends Controller
{
    public function index(Request $request)
    {
        $prices = ProductPrices::latest();
        return view('product::admin.prices.index', compact('prices'));
    }


//    public function create(Request $request)
//    {
//        return view('product::admin.prices.create');
//    }

    public function update(Request $request, $id)
    {
        $price = ProductPrices::findOrFail($id);
        return view('product::admin.prices.update', compact('price'));
    }
}
