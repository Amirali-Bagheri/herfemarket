<?php

namespace Modules\Seo\MetaTags\Entities;

use Modules\Seo\Contracts\MetaTags\Entities\TagInterface;

class Comment implements TagInterface
{
    /**
     * @var string
     */
    protected $openComment;

    /**
     * @var string
     */
    protected $closeComment;

    /**
     * @var TagInterface
     */
    protected $tag;

    /**
     * @param TagInterface $tag
     * @param string $openComment
     * @param string|null $closeComment
     */
    public function __construct(TagInterface $tag, string $openComment, string $closeComment = null)
    {
        $this->tag = $tag;
        $this->openComment = $openComment;
        $this->closeComment = $closeComment ?: $openComment;
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
        return sprintf(<<<COM
<!-- %s -->
%s
<!-- /%s -->
COM
            , $this->openComment, $this->tag->toHtml(), $this->closeComment);
    }

    /**
     * @return string
     */
    public function getPlacement(): string
    {
        return $this->tag->getPlacement();
    }
}
