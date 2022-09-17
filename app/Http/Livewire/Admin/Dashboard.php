<?php

namespace App\Http\Livewire\Admin;

use Analytics;
use App\Models\TriggerRouter;
use Modules\Contact\Entities\Contact;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\User\Entities\User;

class Dashboard extends BaseComponent
{
    public function mount()
    {
        // dd(Analytics::fetchVisitorsAndPageViews(\Spatie\Analytics\Period::days(0))->count());
    }

    public $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public function toolboxAction($action)
    {
        if ($action == 'octane_reload') {
            $output = shell_exec('cd /var/www/laravel && php artisan octane:reload');
        } elseif ($action == 'cache_clear') {
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            \Illuminate\Support\Facades\Artisan::call('route:clear');
            \Illuminate\Support\Facades\Artisan::call('view:clear');
            \Illuminate\Support\Facades\Artisan::call('config:clear');

            $output = \Illuminate\Support\Facades\Artisan::output();
        } elseif ($action == 'queue_clear') {
            // \Illuminate\Support\Facades\Artisan::call('horizon:clear');
            \Illuminate\Support\Facades\Artisan::call('queue:clear --queue=default');
            \Illuminate\Support\Facades\Artisan::call('queue:clear --queue=router');
            \Illuminate\Support\Facades\Artisan::call('queue:clear --queue=listeners');
            \Illuminate\Support\Facades\Artisan::call('queue:clear --queue=emails');
            // \Illuminate\Support\Facades\Artisan::call('queue:clear --queue=webhook');

            $output = \Illuminate\Support\Facades\Artisan::output();
        // dd($output);
        } elseif ($action == 'service_fresh') {
            \Illuminate\Support\Facades\Artisan::call('services:fresh');

            $output = \Illuminate\Support\Facades\Artisan::output();
        // dd($output);
        } else {
            $this->alert('info', 'به زودی', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }

        if ($output) {
            $this->alert('success', __('Operation completed successfully'), [
                'position' => 'center',
                'timer' => '3500',
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', 'عملیات با خطا مواجه شد', [
                'position' => 'center',
                'timer' => '3500',
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }

        $this->emit('refreshComponent');
    }

    public function render()
    {
        $total_success_payments = number_format(price_r2t(\Modules\Payment\Entities\Payment::query()->where('status', 2)->get()->sum('price')));

        return view('admin.dashboard', [
            'contacts'         => Contact::query()->orderBy('created_at')->take(6)->get(),
            'payments'         => \Modules\Payment\Entities\Payment::query()->orderBy('created_at')->take(6)->get(),
            'routers'          => TriggerRouter::latest()->get()->take(8),
            'active_users'     => User::withCount('routers')->get()->sortByDesc('routers_count')->take(5),
            'last_users'       => User::latest()->get()->take(5),
            'last_login_users' => User::orderBy('last_login_at', 'desc')->get()->take(5),
            'total_success_payments' => $total_success_payments,
            'users_count'=>\Modules\User\Entities\User::count(),
            'trigger_routers_count'=>\App\Models\TriggerRouter::count(),
            'comments_pending_count'=>\Modules\Comments\Entities\Comment::pending()->count(),
        ])->extends('admin.layouts.master',
            ['pageTitle' => 'خانه']
        );
    }
}
