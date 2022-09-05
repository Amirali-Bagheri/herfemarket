<?php

namespace Modules\Seo\MetaTags;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Traits\Macroable;
use Modules\Seo\Contracts\MetaTags\Entities\TagInterface;
use Modules\Seo\Contracts\MetaTags\MetaInterface;
use Modules\Seo\Packages\Manager;

class Meta implements MetaInterface
{
    use Macroable;
    use Concerns\ManageTitle;
    use Concerns\ManageMetaTags;
    use Concerns\ManageLinksTags;
    use Concerns\ManagePlacements;
    use Concerns\ManagePackages;
    use Concerns\ManageAssets;
    use Concerns\InitializeDefaults;

    public const PLACEMENT_HEAD = 'head';
    public const PLACEMENT_FOOTER = 'footer';

    /**
     * @var Manager
     */
    protected $packageManager;

    /**
     * @var Repository|null
     */
    private $config;

    /**
     * @param Manager $packageManager
     * @param Repository|null $config
     */
    public function __construct(Manager $packageManager, Repository $config = null)
    {
        $this->config = $config;
        $this->packageManager = $packageManager;

        $this->initPlacements();
    }

    /**
     * @inheritdoc
     */
    public function getTag(string $name): ?TagInterface
    {
        foreach ($this->getPlacements() as $placement) {
            if ($placement->has($name)) {
                return $placement->get($name);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function registerTags(TagsCollection $tags, string $placement = null)
    {
        foreach ($tags as $name => $tag) {
            $this->addTag($name, $tag, $placement);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addTag(string $name, TagInterface $tag, string $placement = null)
    {
        $this->placement($placement ?: $tag->getPlacement())->put($name, $tag);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeTag(string $name)
    {
        foreach ($this->getPlacements() as $placement) {
            $placement->forget($name);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function reset()
    {
        foreach ($this->getPlacements() as $placement) {
            $placement->reset();
        }

        return $this;
    }

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
        return $this->head()->toHtml();
    }

    /**
     * Remove HTML tags
     *
     * @param string $string
     *
     * @return string
     */
    protected function cleanString(?string $string): string
    {
        return e(strip_tags($string));
    }

    /**
     * Get value from config repository
     * If config repository is not set, it returns default value
     *
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    protected function config(string $key, $default = null)
    {
        if (!$this->config) {
            return $default;
        }

        return $this->config->get('meta_tags.' . $key, $default);
    }
}
