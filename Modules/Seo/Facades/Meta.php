<?php

namespace Modules\Seo\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Seo\Contracts\MetaTags\MetaInterface;

class Meta extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return MetaInterface::class;
    }
}
