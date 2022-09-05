<?php

namespace Modules\Menu\Http\Livewire\Admin;

use App\Exports\DatatableExport;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\SubMenu;

class SubMenuDatatable extends BaseComponent
{
    use WithPagination;

    public $query;
    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $columns = [];
    public $tableClass = 'table';
    public $sortIcon = '&#8597;';
    public $sortAscIcon = '&#8593;';
    public $sortDescIcon = '&#8595;';
    public $selected = [];
    public $import;
    public $action_status;
    public Menu $menu;

    public function mount($slug)
    {
        $menu = Menu::firstWhere('slug', $slug);
        $this->menu = $menu;
        // $this->name        = $menu->name;
        // $this->icon        = $menu->icon;
        // $this->slug        = $menu->slug;
        // $this->description = $menu->description;
        // $this->status      = $menu->status;
        // $this->language    = $menu->language;
    }

    public function action()
    {
        $this->forgetComputed();

        foreach (SubMenu::whereIn('id', $this->selected) as $sub_menu) {
            if ($this->action_status) {
                $sub_menu->status = $this->action_status;
            }

            $sub_menu->save();
        }

        $this->dispatchBrowserEvent('success', [
            'title' => 'عملیات با موفقیت انجام شد',
            'timer' => 1500,
            'type' => 'success',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center',
        ]);
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

    public function toggleSelectAll()
    {
        if (count($this->selected) ===
            Menu::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Menu::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
                ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Menu::search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->get()), date('Ymd') . '_menus.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();
        $this->resetPage();

        Menu::whereIn('id', $this->selected)->delete();

        $this->dispatchBrowserEvent('success', [
            'title' => 'عملیات با موفقیت انجام شد',
            'timer' => 1500,
            'type' => 'success',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center',
        ]);
    }

    public function destroy($id): void
    {
        $this->resetPage();

        if (!$id) {
            return;
        }
        $sub_menu = SubMenu::findOrFail($id);

        $sub_menu->delete();

        $this->dispatchBrowserEvent('success', [
            'title' => 'عملیات با موفقیت انجام شد',
            'timer' => 1500,
            'type' => 'success',
            'showCancelButton' => false,
            'showConfirmButton' => false,
            'position' => 'center',
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('menu::livewire.admin.sub-menu-datatable', [
            'sub_menus' => $this->getQuery(),
        ])->extends('admin.layouts.master', ['pageTitle' => 'زیر منو های ' . $this->menu->name]);
    }

    public function getQuery()
    {
        return SubMenu::search($this->search)->where('menu_id', $this->menu->id)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
    }
}
