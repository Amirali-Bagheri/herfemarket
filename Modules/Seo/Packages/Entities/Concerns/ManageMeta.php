<?php

namespace Modules\Seo\Packages\Entities\Concerns;

use Modules\Seo\MetaTags\Entities\Tag;
use Modules\Seo\MetaTags\TagsCollection;

trait ManageMeta
{
    /**
     * @var TagsCollection
     */
    protected $tags;

    /**
     * Get the collection of tags
     *
     * @return TagsCollection
     */
    public function getTags(): TagsCollection
    {
        return $this->tags;
    }

    /**
     * Add custom meta tag
     *
     * @param string $key
     *
     * @param string $content
     *
     * @return $this
     */
    public function addMeta(string $key, string $content)
    {
        $key = $this->prefix . $key;

        $this->tags->put($key, Tag::meta([
            'name' => $key,
            'content' => $content,
        ]));

        return $this;
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
     *
     * @return string
     */
    public function toHtml()
    {
        return $this->tags
            ->map(function ($tag) {
                return $tag->toHtml();
            })
            ->implode(PHP_EOL);
    }

    protected function initTags(): void
    {
        $this->tags = new TagsCollection();
    }
}
