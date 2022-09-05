<?php

namespace Modules\Seo\MetaTags\Entities\Concerns;

use Modules\Seo\MetaTags\Meta;

trait ManagePlacements
{
    /**
     * @var string
     */
    protected $placement = Meta::PLACEMENT_HEAD;

    /**
     * @return string
     */
    public function getPlacement(): string
    {
        return $this->placement;
    }

    /**
     * @param string $placement
     *
     * @return $this
     */
    public function setPlacement(string $placement)
    {
        $this->placement = $placement;

        return $this;
    }
}
