<?php

namespace Modules\Business\Http\Livewire\Site;

use Illuminate\Pagination\Paginator;
use Jenssegers\Agent\Facades\Agent;
use Livewire\WithPagination;
use Modules\Business\Entities\Business;
use Modules\Category\Entities\Category;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Seo\Facades\Meta;
use Modules\Setting\Entities\Setting;

class Businesses extends BaseComponent
{
    use WithPagination;

    public $url;
    public $query;
    public $search = '';
    public $filter = '';
    public $page = 1;
    public $perPage = 20;
    public $sortField = 'id';
    public $sortAsc = true;
    public $columns = [];
    public $sortIcon = '&#8597;';
    public $sortAscIcon = '&#8593;';
    public $sortDescIcon = '&#8595;';
    public $readyToLoad = false;
    protected $updatesQueryString = ['search'];

    public function mount($url = null): void
    {
        $this->url = $url;
        $this->search = request()->query('search', $this->search);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingBrandsFilter()
    {
        $this->resetPage();
    }


    public function getUpdatesQueryString()
    {
        return;
    }

    public function initializeWithPagination()
    {
        Paginator::currentPageResolver(function () {
            return $this->page;
        });

        Paginator::defaultView($this->paginationView());
    }

    public function loadBusinesses()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $url = $this->url;
        $search = $this->search;

        Meta::setTitleSeparator('-')->setTitle('کسب و کار ها')->prependTitle(Setting::get('seo_meta_title'));

//        if (!isset($url) and empty($search)) {
//            $categories = Category::active()->where('parent_id', 0)->get();
//            $businesses = [];

//            Meta::setTitleSeparator('-')->setTitle('دسته بندی کالاها')->prependTitle(Setting::get('seo_meta_title'));
//
//        }
//        else {
        if (Category::where('slug', $url)->exists()) {
            $category = Category::firstWhere('slug', $url);
            $subCategories = $category->getAllChildren()->pluck('id')->merge($category['id']);

            $query = Business::where('status', 1)->whereHas('categories', function ($query) use ($subCategories) {
                $query->whereIn('categories.id', $subCategories);
            })->active();
            Meta::setTitleSeparator('-')->setTitle('کسب و کار های دسته ' . $category->title)->prependTitle(Setting::get('seo_meta_title'));
        }
        if (!isset($query)) {
            $query = Business::active()->latest();
        }

        $businesses = $query
            ->when(!empty($search), function ($query) use ($search) {
                $matching = Business::search($search)->where('status', 1)->get()->pluck('id');
                Meta::setTitleSeparator('-')->setTitle('جستجوی ' . $search)->prependTitle(Setting::get('seo_meta_title'));
                $query->whereIn('id', $matching);
            })
            ->withCount('prices')
//                ->withCount('visits')
            ->filter($this->filter, $this->perPage);
//        }

        $businesses = $businesses->paginate($this->perPage);

        if (Agent::isMobile()) {
            return view('business::mobile.businesses', [
                'url' => $url ?? null,
                'businesses' => $this->readyToLoad ? $businesses : collect([])->paginate($this->perPage),
                'category' => $category ?? null,
                'categories' => $categories ?? null,
            ])->extends('mobile.layouts.master');
        }
        return view('business::site.businesses', [
                'url' => $url ?? null,
                'businesses' => $this->readyToLoad ? $businesses : collect([])->paginate($this->perPage),
                'category' => $category ?? null,
                'categories' => $categories ?? null,
            ])->extends('site.layouts.master');
    }
}
