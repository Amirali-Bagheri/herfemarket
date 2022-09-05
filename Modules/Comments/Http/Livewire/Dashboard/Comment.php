<?php

namespace Modules\Comments\Http\Livewire\Dashboard;

use src\Illuminate\Support\Facades\Auth;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\User\Entities\User;

class Comment extends BaseComponent
{
    public $model;
    public $comments;
    public $body;
    public $rating;
    public $captcha;

    public function mount($model)
    {
        $this->model    = $model;
        $this->comments = $model->comments;
    }

    public function comment($parent_id = 0)
    {
        if (! Auth::check()) {
            $this->dispatchBrowserEvent('success', [
                'title'             => 'قبل از ثبت کردن دیدگاه باید وارد سایت شوید یا ثبت نام کنید',
                'timer'             => 1500,
                'type'              => 'error',
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);
        }
        $this->validate([
            'body' => 'required',
        ]);

        $user = User::find(Auth::id());

        $comment = $this->model->comments()->create([
            'body'      => $this->body,
            'parent_id' => $parent_id,
            'user_id'   => $user->id,
        ]);

        if ($user->hasRole('admin')) {
            $comment->markApproved();
        }

        if (isset($this->rating)) {
            $this->model->rating()->updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'rating' => $this->rating,
                ]
            );
        }

        if ($comment) {
            $this->dispatchBrowserEvent('success', [
                'title'             => 'دیدگاه شما با موفقیت ارسال شد و پس از تایید توسط مدیریت منتشر خواهد شد',
                'timer'             => 2000,
                'type'              => 'success',
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);
        } else {
            $this->dispatchBrowserEvent('success', [
                'title'             => 'خطایی در ارسال دیدگاه رخ داد!',
                'timer'             => 6000,
                'type'              => 'error',
                'showCancelButton'  => false,
                'showConfirmButton' => false,
                'position'          => 'center',
            ]);
        }
    }

    public function render()
    {
        return view('comments::dashboard.comment');
    }
}
