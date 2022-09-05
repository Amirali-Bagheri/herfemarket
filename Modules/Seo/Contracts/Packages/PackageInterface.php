<?php

namespace Modules\Seo\Contracts\Packages;

use Illuminate\Contracts\Support\Htmlable;
use Modules\Seo\MetaTags\TagsCollection;

interface PackageInterface extends Htmlable
{
    /**
     * Get the package name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the collection of tags
     *
     * @return TagsCollection
     */
    public function getTags(): TagsCollection;
}
