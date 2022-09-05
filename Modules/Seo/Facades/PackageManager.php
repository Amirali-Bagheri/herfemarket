<?php

namespace Modules\Seo\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Seo\Contracts\Packages\ManagerInterface;

class PackageManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ManagerInterface::class;
    }
}
