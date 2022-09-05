<?php

use Modules\Blog\Http\Controllers\Admin\CategoryController;
use Modules\Blog\Http\Controllers\Site\PostsController;
use Modules\Blog\Http\Livewire\Admin\Create;
use Modules\Blog\Http\Livewire\Admin\Datatable;
use Modules\Blog\Http\Livewire\Admin\Update;

Route::prefix('admin')->middleware(['web', 'auth', 'role:admin',])->group(function () {
    Route::group(['prefix' => 'blog/posts'], function () {
        Route::any('/', Datatable::class)->name('admin.posts.index');
        Route::any('create', Create::class)->name('admin.posts.create');
        Route::any('update/{id}', Update::class)->name('admin.posts.update');
        // Route::any('delete/{id}', 'PostsController@destroy')->name('admin.posts.delete');
        // Route::any('deleteAll', 'PostsController@deleteAll')->name('admin.posts.deleteAll');
        // Route::get('export', 'PostsController@export')->name('admin.posts.export');
        // Route::post('import', 'PostsController@import')->name('admin.posts.import');
        // Route::get('search', 'PostsController@search')->name('admin.posts.search');
        // Route::any('show/{id}', 'PostsController@show')->name('admin.posts.show');
    });

    Route::group(['prefix' => 'blog/categories'], function () {
        Route::any('/', [CategoryController::class, 'index'])
            ->name('admin.blog.categories.index');
        Route::any('create', [CategoryController::class, 'create'])
            ->name('admin.blog.categories.create');
        Route::any('update/{id}', [CategoryController::class, 'update'])
            ->name('admin.blog.categories.update');
        Route::any('delete/{id}', [CategoryController::class, 'destroy'])
            ->name('admin.blog.categories.delete');
        Route::any('deleteAll', [CategoryController::class, 'deleteAll'])
            ->name('admin.blog.categories.deleteAll');
        Route::get('export', [CategoryController::class, 'export'])
            ->name('admin.blog.categories.export');
        Route::post('import', [CategoryController::class, 'import'])
            ->name('admin.blog.categories.import');
        Route::get('search', [CategoryController::class, 'search'])
            ->name('admin.blog.categories.search');
        Route::any('show/{id}', [CategoryController::class, 'show'])
            ->name('admin.blog.categories.show');
    });
});

// Route::feeds();

Route::prefix('blog')->group(function () {
    Route::any('/', [PostsController::class, 'index'])->name('site.blog');
    Route::any('/post/{slug}', [PostsController::class, 'show'])->name('site.blog.single');
    Route::any('/search', [PostsController::class, 'search'])->name('site.blog.search');
    Route::get('/category', [PostsController::class, 'categories'])->name('site.blog.categories');
    Route::get('/category/{slug}', [PostsController::class, 'category'])->name('site.blog.category');
});

//Route::get('/blog', \Modules\Blog\Http\Livewire\Site\ListPosts::class)->name('site.blog');
//Route::get('/blog/post/{slug}', \Modules\Blog\Http\Livewire\Site\Single::class)->name('site.blog.single');
//Route::get('/blog/category/{slug}', \Modules\Blog\Http\Livewire\Site\Category::class)->name('site.blog.category');
