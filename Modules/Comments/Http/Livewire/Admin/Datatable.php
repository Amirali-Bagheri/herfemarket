<?php

namespace Modules\Comments\Http\Livewire\Admin;

use App\Exports\DatatableExport;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Comments\Entities\Comment;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Core\Http\Livewire\CRUD\DatatableTrait;
use Modules\User\Entities\User;

class Datatable extends BaseComponent
{
    use WithPagination;
    use DatatableTrait;

    public $user = null;
    public $comment;
    protected $listeners = [
        'approveComment',
        'rejectComment',
        'updateStatus',
    ];

    public function mount($user_id = null)
    {
        if (!empty($user_id)) {
            $this->user = User::find($user_id);
        }
    }

    public function action()
    {
        $this->forgetComputed();

        foreach (Comment::whereIn('id', $this->selected) as $category) {
            if ($this->action_status) {
                $category->status = $this->action_status;
            }

            $category->save();
        }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function toggleSelectAll()
    {
        if (count($this->selected) ===
            Comment::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->count()) {
            $this->selected = [];
        } else {
            $this->selected = Comment::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get()
                ->pluck('id')->values()->toArray();
        }
        $this->forgetComputed();
    }

    public function export()
    {
        $this->forgetComputed();

        return Excel::download(new DatatableExport(Comment::search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->get()), date('Ymd') . '_comments.xlsx');
    }

    public function deleteAll()
    {
        $this->forgetComputed();
        $this->resetPage();

        Comment::whereIn('id', $this->selected)->delete();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function destroy($id)
    {
        $this->resetPage();

        if (!$id) {
            return;
        }
        $category = Comment::withAnyStatus()->findOrFail($id);

        $category->delete();

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function updateStatus($id)
    {
        $this->comment = Comment::withAnyStatus()->find($id);

        $this->confirm('وضعیت دیدگاه را انتخاب کنید', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'cancelButtonText' => 'رد',
            'confirmButtonText' => 'تایید',
            'onConfirmed' => 'approveComment',
            'onCancelled' => 'rejectComment',
        ]);
    }

    public function approveComment()
    {

        $this->comment->markApproved();

        $this->alert('success', 'انجام شد', [
            'position' => 'bottom-start',
            'timer' => 3000,
            'toast' => true,
            'text' => 'وضعیت دیدگاه با موفقیت تغییر کرد',
            'confirmButtonText' => 'Ok',
            'cancelButtonText' => 'Cancel',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
        $this->comment = null;
    }

    public function rejectComment()
    {
        $this->comment->markRejected();

        $this->alert('success', 'انجام شد', [
            'position' => 'bottom-start',
            'timer' => 3000,
            'toast' => true,
            'text' => 'وضعیت دیدگاه با موفقیت تغییر کرد',
            'confirmButtonText' => 'Ok',
            'cancelButtonText' => 'Cancel',
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
        $this->comment = null;
    }

    public function render()
    {
        return view('comments::admin.index', [
            'comments' => $this->getQuery(),
        ])->extends('admin.layouts.master', ['pageTitle' => 'دسته بندی ها']);
    }

    public function getQuery()
    {
        if (!empty($this->user)) {
            return $this->user->comments()->withAnyStatus()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage);
        }

        return Comment::search($this->search)->withAnyStatus()->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }
}
