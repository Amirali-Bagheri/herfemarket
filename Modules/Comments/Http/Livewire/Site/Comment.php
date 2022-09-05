<?php

namespace Modules\Comments\Http\Livewire\Site;

use Illuminate\Support\Facades\Auth;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\User\Entities\User;
use Throwable;

class Comment extends BaseComponent
{
    public $model;
    public $comments;
    public $body;
    public $rating;
    public $captcha;
    protected $listeners = [
        'goLogin',
    ];

    public function mount($model)
    {
        $this->model    = $model;
        $this->comments = $model->comments;
    }

    public function setRating($i)
    {
        $this->rating = $i;
    }

    public function goLogin()
    {
        $this->redirect(route('login'));
    }

    public function comment($parent_id = 0)
    {
        try {
            if (! Auth::check()) {
                self::alert('error', 'خطا', [
                    'position'          => 'center',
                    'timer'             => '10000',
                    'toast'             => false,
                    'text'              => 'قبل از ثبت کردن دیدگاه باید وارد سایت شوید یا ثبت نام کنید',
                    'confirmButtonText' => 'ورود یا ثبت نام',
                    'showCancelButton'  => false,
                    'showConfirmButton' => true,
                    'onConfirmed'       => 'goLogin',
                ]);
            } else {
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
                    $ratingModel = $this->model->ratings()->updateOrCreate(
                        [
                            'user_id' => $user->id,
                        ],
                        [
                            'rating' => $this->rating,
                        ]
                    );
                    $ratingModel->save();
                }

                if ($comment) {
                    self::alert('success', 'دیدگاه شما ارسال شد', [
                        'position'          => 'center',
                        'timer'             => '3000',
                        'toast'             => false,
                        'text'              => 'دیدگاه شما با موفقیت ارسال شد و پس از تایید منتشر خواهد شد',
                        'showCancelButton'  => false,
                        'showConfirmButton' => false,
                    ]);
                } else {
                    self::alert('success', 'خطا!', [
                        'position'          => 'center',
                        'timer'             => '3000',
                        'toast'             => false,
                        'text'              => 'خطایی در ارسال دیدگاه رخ داد!',
                        'showCancelButton'  => false,
                        'showConfirmButton' => false,
                    ]);
                }
            }
        } catch (Throwable $ex) {
            self::alert('success', 'خطا!', [
                'position'          => 'center',
                'timer'             => '3000',
                'toast'             => false,
                'text'              => 'خطایی در ارسال دیدگاه رخ داد!',
                'showCancelButton'  => false,
                'showConfirmButton' => false,
            ]);
            throw $ex;
        }
    }

    public function render()
    {
        return view('livewire.site.comment');
    }
}
