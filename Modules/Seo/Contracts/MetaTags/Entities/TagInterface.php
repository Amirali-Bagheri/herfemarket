<?php

namespace Modules\Seo\Contracts\MetaTags\Entities;

use Illuminate\Contracts\Support\Htmlable;

interface TagInterface extends Htmlable
{
    /**
     * @return string
     */
    public function getPlacement(): string;
}
