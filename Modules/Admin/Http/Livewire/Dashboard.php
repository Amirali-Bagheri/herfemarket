<?php

namespace Modules\Admin\Http\Livewire;

use Carbon\Carbon;
use Modules\Contact\Entities\Contact;
use Modules\Core\Http\Livewire\BaseComponent;
use Spatie\Analytics\Period;

class Dashboard extends BaseComponent
{
    public function mount()
    {
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
//            \Illuminate\Support\Facades\Artisan::call('horizon:clear');
            \Illuminate\Support\Facades\Artisan::call('queue:clear --queue=default');
            \Illuminate\Support\Facades\Artisan::call('queue:clear --queue=crawling');
            \Illuminate\Support\Facades\Artisan::call('queue:clear --queue=new_scrape');
            \Illuminate\Support\Facades\Artisan::call('queue:clear --queue=exist_scrape');
            \Illuminate\Support\Facades\Artisan::call('queue:clear --queue=pricing');
            \Illuminate\Support\Facades\Artisan::call('queue:clear --queue=scrape');

            $output = \Illuminate\Support\Facades\Artisan::output();
        } else {
            $this->alert('info', 'به زودی', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }

        if ($output) {
            $this->alert('success', 'عملیات با موفقیت انجام شد', [
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
//        try {
//            $daily_visits = 0;
//            $daily_visits = \Analytics::fetchVisitorsAndPageViews(Period::days(0))->count();
//            $online_visits = Analytics::getAnalyticsService()->data_realtime->get('ga:' . env('ANALYTICS_VIEW_ID'), 'rt:activeVisitors')->totalsForAllResults['rt:activeVisitors'];

//            $days = 30;
//            $users = Analytics::performQuery(Period::days($days),'ga:users',['dimensions'=>'ga:campaign,ga:source,ga:medium']);

//            if (isset($daily_visits) && cache('daily_visits') != $daily_visits) {
//                Cache::forever('daily_visits', $daily_visits ?? 0);
//                Cache::put('daily_visits', , 3600);
//            }

//            Cache::put('online_visits', $online_visits ?? '0', 3600);

//        } catch (ConnectException $exception) {
//            Cache::forever('daily_visits', '-');
//        } catch (Exception $exception) {
//            Cache::forever('daily_visits', '-');
//
//        }

        $businesses = \Modules\Business\Entities\Business::withCount('prices')
//            ->withCount([
//                'crawled_products',
//                'crawled_products as latest_crawled_products_count' => function ($query) {
//                    $query->where('created_at', "<", Carbon::now()->subDays(2));
//                }])

            ->orderBy('prices_count', 'desc')
//            ->cacheFor(3600 * 24)
            ->get()->take(5);

//        dd($businesses->first()->latest_crawled_products_count);

        $links = \Modules\Crawl\Entities\Link::whereNot('business_id', 1)->get()->sortByDesc('latest_crawled_products_count');
        return view('admin::home', [
            'links'=>$links,
            'contacts' => Contact::latest()->paginate(15),
            'businesses' => $businesses,
        ])->extends('admin.layouts.master', ['pageTitle' => 'پنل مدیریت']);
    }
}
