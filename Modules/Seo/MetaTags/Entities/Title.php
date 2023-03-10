<?php

namespace Modules\Seo\MetaTags\Entities;

use Modules\Seo\Contracts\MetaTags\Entities\TitleInterface;

class Title implements TitleInterface
{
    use Concerns\ManageMaxLength;

    public const DEFAULT_LENGTH = null;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $separator = '|';

    /**
     * @var array
     */
    protected $prepend = [];

    /**
     * @var bool
     */
    protected $rtl = false;

    /**
     * @param string|null $title
     * @param int $maxLength
     */
    public function __construct(string $title = null, int $maxLength = null)
    {
        $this->title = $title;
        $this->setMaxLength($maxLength);
    }

    /**
     * @inheritdoc
     */
    public function getPlacement(): string
    {
        return 'head';
    }

    /**
     * @inheritdoc
     */
    public function setTitle(?string $title, int $maxLength = null)
    {
        $this->title = $title;
        $this->setMaxLength($maxLength);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function prepend(string $text)
    {
        $this->prepend[] = $text;

        return $this;
    }

    /**
     * Toggle RTL mode
     *
     * @param bool $status
     *
     * @return $this
     */
    public function rtl(bool $status = true)
    {
        $this->rtl = $status;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setSeparator(string $separator)
    {
        $this->separator = trim($separator);

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
     * @inheritdoc
     */
    public function toHtml()
    {
        return sprintf('<title>%s</title>', $this->makeTitle());
    }

    /**
     * @return string
     */
    protected function makeTitle(): string
    {
        $separator = " {$this->separator} ";
        $title = '';

        if (!empty($this->prepend)) {
            $parts = $this->rtl ? $this->prepend : array_reverse($this->prepend);
            $title = implode($separator, $parts);
        }

        if (!empty($title) && !empty($this->title)) {
            if ($this->rtl) {
                $title = $this->title . $separator . $title;
            } else {
                $title .= $separator . $this->title;
            }
        } elseif (!empty($this->title)) {
            $title = $this->title;
        }

        return $this->limitString($title);
    }
}
