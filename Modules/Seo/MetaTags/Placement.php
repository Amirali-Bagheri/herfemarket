<?php

namespace Modules\Seo\MetaTags;

use Illuminate\Contracts\Support\Htmlable;
use Modules\Seo\Contracts\MetaTags\PlacementInterface;

class Placement extends TagsCollection implements PlacementInterface
{
    /**
     * Clear bag
     */
    public function reset(): void
    {
        $this->items = [];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toHtml();
    }

    /**
     * Get content as a string of HTML.
     * @return string
     */
    public function toHtml()
    {
        return $this->map(function ($tag) {
            if ($tag instanceof Htmlable) {
                return $tag->toHtml();
            }

            return (string)$tag;
        })->implode(PHP_EOL);
    }
}
