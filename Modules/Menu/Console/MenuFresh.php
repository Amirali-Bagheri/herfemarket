<?php

namespace Modules\Menu\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MenuFresh extends Command
{
    protected $signature = 'menu:fresh';
    protected $description = 'Command description.';

    public function handle()
    {
        DB::table('sub_menus')->truncate();
        DB::table('menus')->truncate();
        Artisan::call('db:seed --class=MenusSeeder');
    }
}
