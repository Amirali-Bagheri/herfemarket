<?php

namespace Modules\User\Http\Livewire\Admin;

use Modules\Comments\Entities\Comment;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\User\Entities\User;

class Show extends BaseComponent
{
    public $user;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    public function render()
    {
        $reports = $this->user->reports;
        $inquiries = $this->user->inquiries;
        $payments = $this->user->payments;
        $comments = Comment::withAnyStatus()->where('user_id', $this->user->id)->paginate(10);

        return view('user::show', [
            'comments' => $comments,
            'reports' => $reports,
            'payments' => $payments,
            'inquiries' => $inquiries,
        ]);
    }
}
