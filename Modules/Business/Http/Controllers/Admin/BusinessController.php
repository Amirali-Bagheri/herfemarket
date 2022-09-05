<?php

namespace Modules\Business\Http\Controllers\Admin;

use App\Exports\BusinessesExport;
use App\Http\Controllers\Controller;
use App\Imports\BusinessesImport;
use EloquentBuilder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Business\Entities\Business;
use Modules\Product\Entities\ProductPrices;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
//        $businesses = Business::latest()->paginate(10);
        return view('business::admin.index');
    }

    public function create(Request $request)
    {
        return view('business::admin.create');
    }

    public function update(Request $request, $id)
    {
        $business = Business::findOrFail($id);
        return view('business::admin.update')->withBusiness($business);
//
//        if ($request->isMethod('get')) {
//            $business = Business::findOrFail($id);
//            $categories = Category::orderByRaw('-title ASC')->get()->nest()->setIndent('|–– ')->listsFlattened('title');
//
//            return view('business::admin.update', compact('business', 'categories'));
//        }
//
//        return $request->all();

//        $request->validate([
//            'name' => 'required|max:255',
//            'business_type' => 'required|max:255',
////            'description' => 'required|max:380|min:10',
//            'categories' => 'required',
////            'latitude' => 'required',
////            'longitude' => 'required',
//
////            'business_address' => 'required',
//            'business_logo' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
//
//            'business_phone' => 'sometimes|nullable|min:11|max:11|regex:/[0-9]{10}/|digits:11|unique:businesses,phone,' . $business->id,
//            'business_email' => 'sometimes|nullable|unique:businesses,email,' . $business->id,
////            'sale_expert_first_name' => 'max:255',
////            'sale_expert_last_name' => 'max:255',
////            'sale_expert_mobile' => 'max:12|unique:sales_experts,mobile',
//
//            'state' => 'required',
//            'city' => 'required',
//        ]);

//        if ($request->has('transaction') and $request->has('amount')) {
//            $balance_after_transaction = $business->balance;
//
//            if ($request['transaction'] == 'deposit') {
//                $business->deposit($request['amount'], [
//                    'description' => $request['transaction_description'],
//                    'balance_after_transaction' => $balance_after_transaction - $request['amount']
//
//                ]);
//            } elseif ($request['transaction'] == 'deposit') {
//                $business->forceWithdraw($request['amount'], [
//                    'description' => $request['transaction_description'],
//                    'balance_after_transaction' => $balance_after_transaction + $request['amount']
//
//                ]);
//
//            }
//        }
//        $business->balance = $request->wallet;

        // Business
        /*  $business->update([
              'name' => $request->name,
              'description' => $request->description,
              'phone' => $request->business_phone,
              'fax' => $request->business_fax,
              'latitude' => $request->latitude,
              'longitude' => $request->longitude,
              'address' => $request->business_address,
              'website' => $request->business_website,
              'type_id' => $request->business_type,
              'email' => $request->business_email,
  //            'manager_id' => $user->id,

              'social_telegram' => $request->social_telegram,
              'social_whatsapp' => $request->social_whatsapp,
              'social_instagram' => $request->social_instagram,

              'state_id' => $request->state,
              'city_id' => $request->city,
              'status' => $request->status,

          ]);
          if ($request->has('business_logo')) {

              $business_logo = $request->file('business_logo');

              $basename = $business_logo->getClientOriginalName();
              $extension = $business_logo->getClientOriginalExtension();
              $business_logoName = $business->id . '_logo' . time() . '.' . basename($basename, '.' . $extension);
              $slug = Str::slug($business_logoName, '-');
              $upload_success = $business_logo->move('uploads/logos', $slug . '.' . $extension);

              $business->logo = $slug . '.' . $extension;
          }
          if ($request->has('categories')) {
              $business->categories()->sync($request['categories']);
  //            foreach ($request->categories as $categoryID) {
  //                $category = Category::find($categoryID);
  //                $business->categories()->sync($category->id);
  //                $business->categories()->attach($category->parents->pluck('id'));
  //            }
          }

          if ($request->has('sale_expert_first_name') and $request->has('sale_expert_last_name') and $request->has('sale_expert_mobile')) {
              $business->sales_experts()->create([
                  'first_name' => $request->sale_expert_first_name,
                  'last_name' => $request->sale_expert_last_name,
                  'mobile' => $request->sale_expert_mobile,
              ]);
          }

          $business->save();

          return redirect()->back()->withInput()->with(['success' => 'ویرایش با موفقیت انجام شد']);*/
    }

    public function delete($id)
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/businesses/delete/{user_id}')
         * @name('admin.businesses.delete')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        //        if ($id && ctype_digit($id)) {
        //            $businessItem = Business::find($id);
        //            if ($businessItem && $businessItem instanceof Business) {
        //                $businessItem->delete();
        //                return redirect()->route('admin.businesses.index')->with('success', 'کسب و کار مورد نظر با موفقیت حذف گردید.');
        //            }
        //        }
        $business = Business::findOrFail($id);

        visits($business)->reset();

        $business->manager()->delete();
        $business->prices()->delete();
        $business->rating()->delete();
        $business->inquiries()->delete();
        $business->responses()->delete();
        $business->categories()->detach($business->categories()->pluck('id'));
        $business->reports()->delete();

        $business->delete();

        return back()->with('success', 'کسب و کار مورد نظر با موفقیت حذف گردید.');
    }

    public function deleteAll(Request $request)
    {
        /**
         * @methods(GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS)
         * @uri('/admin/businesses/deleteAll')
         * @name('admin.businesses.deleteAll')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        $ids = $request->ids;

        Business::whereIn('id', explode(",", $ids))->delete();

        return response()->json([
            'status' => true,
            'message' => "کسب و کار مورد نظر با موفقیت حذف گردید.",
        ]);
    }

    public function export()
    {
        /**
         * @get('/admin/businesses/export')
         * @name('admin.businesses.export')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */

        return Excel::download(new BusinessesExport(), date('Ymd') . '_businesses.xlsx');
    }

    public function import(Request $request)
    {
        /**
         * @post('/admin/businesses/import')
         * @name('admin.businesses.import')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        Excel::import(new BusinessesImport(), request()->file('excel'));


        return back()->with('success', 'Excel Data Imported successfully.');
    }

    public function search(Request $request)
    {
        /**
         * @get('/admin/businesses/search')
         * @name('admin.businesses.search')
         * @middlewares(web, auth, role:admin, verifiedphone)
         */
        $businesses = Business::where('name', 'LIKE', "%{$request->input('s')}%")->orWhere('description', 'LIKE', "%{$request->input('s')}%")->paginate(10);

        return view('business::admin.index', compact('businesses'));
    }

    public function filter(Request $request)
    {
        $businesses = EloquentBuilder::to(Business::class, $request->all());

        return $businesses->get();
    }

    public function deletePrice(Request $request, $id)
    {
        $productPrice = ProductPrices::find($id)->delete();
//        $productPrice = ProductPrices::where('product_id', $id)->where('business_id', $request->business_id)->delete();
        return redirect()->back()->with('swal_success', 'قیمت مورد نظر با موفقیت حذف گردید.');

//        return response()->json(['data' => $productPrice], 200, [], JSON_NUMERIC_CHECK);
    }

    public function deleteAllPrices(Request $request)
    {
        $ids = $request->delete_prices;
        ProductPrices::whereIn('id', $ids)->delete();

        return redirect()->back()->with('swal_success', 'موارد انتخاب شده با موفقیت حذف گردید.');
    }
}
