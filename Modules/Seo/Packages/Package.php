<?php

namespace Modules\Seo\Packages;

use Modules\Seo\Contracts\Packages\PackageInterface;
use Modules\Seo\Contracts\WithDependencies;
use Modules\Seo\MetaTags\Meta;
use Modules\Seo\MetaTags\PlacementsBag;
use Modules\Seo\MetaTags\TagsCollection;
use Modules\Seo\Packages\Concerns\Dependencies;

class Package extends Meta implements PackageInterface, WithDependencies
{
    use Dependencies;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->placements = new PlacementsBag();
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the collection of tags
     *
     * @return TagsCollection
     */
    public function getTags(): TagsCollection
    {
        return new TagsCollection();
    }
}
