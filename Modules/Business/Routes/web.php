<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Modules\Business\Http\Controllers\Admin\BusinessController;
use Modules\Business\Http\Livewire\Update;

//    Route::get('/businesses/{url}', 'BusinessController@businesses')->name('site.businesses');
//    Route::any('/businesses', 'BusinessController@index')->name('site.businesses');
//    Route::match(['get', 'post'], '/businesses/filter', 'BusinessController@filtering')->name('site.businesses.filter');

//    Route::any('/categories/businesses/children/{slug}', 'BusinessController@categoryChildren')->name('site.businesses.category.children');

//    Route::get('/search/businesses', 'BusinessController@businessSearch')->name('site.businesses.search');

//    Route::any('/business/{slug}', 'BusinessController@business')->name('site.businesses.single');
//Route::get('/categories/category/{slug}', 'BusinessController@category')->name('site.businesses.category');
Route::any('/buy/{id}', [\Modules\Business\Http\Controllers\Site\BusinessController::class, 'priceLink'])->name('site.product.price.link');
Route::any('/redirect/{md5}', [\Modules\Business\Http\Controllers\Site\BusinessController::class, 'websiteLink'])->name('site.business.website.link');

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin'])->group(function () {
    Route::group(['prefix' => 'businesses'], function () {
        Route::any('/', \Modules\Business\Http\Livewire\Datatable::class)->name('admin.businesses.index');
        Route::any('create', [BusinessController::class, 'create'])->name('admin.businesses.create');
//        Route::any('update/{id}', [BusinessController::class,'update'])->name('admin.businesses.update');
        Route::any('update/{id}', Update::class)->name('admin.businesses.update');

        Route::any('delete_price/{id}', [BusinessController::class, 'deletePrice'])->name('admin.businesses.delete_price');
        Route::any('delete/{user_id}', [BusinessController::class, 'delete'])->name('admin.businesses.delete');
        Route::any('deleteAll', [BusinessController::class, 'deleteAll'])->name('admin.businesses.deleteAll');
        Route::any('deleteAllPrices', [BusinessController::class, 'deleteAllPrices'])->name('admin.businesses.deleteAllPrices');
        Route::get('export', [BusinessController::class, 'export'])->name('admin.businesses.export');
        Route::post('import', [BusinessController::class, 'import'])->name('admin.businesses.import');
        Route::get('search', [BusinessController::class, 'search'])->name('admin.businesses.search');
        Route::any('show/{id}', [BusinessController::class, 'show'])->name('admin.businesses.show');
    });
});
