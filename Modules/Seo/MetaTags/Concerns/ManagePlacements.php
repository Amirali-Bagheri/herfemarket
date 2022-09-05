<?php

namespace Modules\Seo\MetaTags\Concerns;

use Modules\Seo\Contracts\MetaTags\PlacementInterface;
use Modules\Seo\MetaTags\PlacementsBag;

trait ManagePlacements
{
    /**
     * @var PlacementsBag
     */
    protected $placements;

    /**
     * @inheritdoc
     */
    public function head(): PlacementInterface
    {
        return $this->placement(static::PLACEMENT_HEAD);
    }

    /**
     * @inheritdoc
     */
    public function placement(string $name): PlacementInterface
    {
        return $this->placements->getBag($name);
    }

    /**
     * @inheritdoc
     */
    public function footer(): PlacementInterface
    {
        return $this->placement(static::PLACEMENT_FOOTER);
    }

    /**
     * @inheritdoc
     */
    public function getPlacements(): array
    {
        return $this->placements->all();
    }

    protected function initPlacements(): void
    {
        $this->placements = new PlacementsBag();
    }
}
