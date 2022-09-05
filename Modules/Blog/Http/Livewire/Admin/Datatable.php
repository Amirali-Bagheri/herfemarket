<?php

namespace Modules\Blog\Http\Livewire\Admin;

use App\Exports\DatatableExport;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Blog\Entities\Post;
use Modules\Core\Http\Livewire\BaseComponent;

class Datatable extends BaseComponent
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

    public function action()
    {
        $this->forgetComputed();

        foreach (Post::whereIn('id', $this->selected) as $post) {
            if ($this->action_status) {
                $post->status = $this->action_status;
            }

            $post->save();
        }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
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
            Post::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Post::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
                ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Post::search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->get()), date('Ymd') . '_posts.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();
        $this->resetPage();

        Post::whereIn('id', $this->selected)->delete();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function destroy($id): void
    {
        $this->resetPage();

        if (!$id) {
            return;
        }
        $post = Post::findOrFail($id);

        $post->delete();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $posts = $this->getQuery();

        return view('blog::admin.index', [
            'posts' => $this->getQuery(),
        ])->extends('admin.layouts.master', ['pageTitle' => 'پست ها']);
    }

    public function getQuery()
    {
        return Post::all()->paginate($this->perPage);

        return Post::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
    }
}
