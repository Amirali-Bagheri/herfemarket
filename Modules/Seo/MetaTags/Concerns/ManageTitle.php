<?php

namespace Modules\Seo\MetaTags\Concerns;

use Modules\Seo\Contracts\MetaTags\Entities\TitleInterface;
use Modules\Seo\MetaTags\Entities\Title;

trait ManageTitle
{
    /**
     * @inheritdoc
     */
    public function setTitleSeparator(string $separator)
    {
        $this->getTitle()->setSeparator($separator);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTitle(): ?TitleInterface
    {
        $title = $this->getTag('title');

        if (!$title) {
            $this->addTag('title', $title = new Title());
        }

        return $title;
    }

    /**
     * @inheritdoc
     */
    public function prependTitle(?string $text)
    {
        $title = $this->getTitle();

        if ($title) {
            $title->prepend($this->cleanString($text));
        } else {
            $this->setTitle($text);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setTitle(?string $title, int $maxLength = null)
    {
        if (is_null($maxLength)) {
            $maxLength = $this->config('title.max_length');
        }

        $this->getTitle()->setTitle($this->cleanString($title), $maxLength);

        return $this;
    }
}
