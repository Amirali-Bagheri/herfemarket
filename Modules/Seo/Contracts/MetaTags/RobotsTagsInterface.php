<?php

namespace Modules\Seo\Contracts\MetaTags;

interface RobotsTagsInterface
{
    /**
     * Get the meta robots
     *
     * @return string|null
     */
    public function getRobots(): ?string;
}
