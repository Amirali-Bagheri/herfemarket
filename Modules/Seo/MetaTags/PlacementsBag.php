<?php

namespace Modules\Seo\MetaTags;

use Illuminate\Support\Arr;
use Modules\Seo\Contracts\MetaTags\PlacementInterface;

class PlacementsBag
{
    /**
     * The array of the view error bags.
     *
     * @var array
     */
    protected $bags = [];

    /**
     * Get a Placement instance from the bags.
     *
     * @param string $key
     * @return PlacementInterface
     */
    public function getBag(string $key): PlacementInterface
    {
        return Arr::get($this->bags, $key) ?: $this->makeBug($key);
    }

    /**
     * Create a new Placement
     *
     * @param string $key
     *
     * @return Placement
     */
    public function makeBug(string $key)
    {
        return $this->bags[$key] = new Placement();
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->bags;
    }
}
