<?php

namespace Modules\Seo\MetaTags\Entities;

use BadMethodCallException;
use Modules\Seo\Contracts\MetaTags\Entities\TagInterface;
use Modules\Seo\MetaTags\Entities\Builders\YandexMetrikaCounterBuilder;
use Modules\Seo\MetaTags\Meta;

/**
 * @mixin YandexMetrikaCounterBuilder
 */
class YandexMetrika implements TagInterface
{
    /**
     * @var YandexMetrikaCounterBuilder
     */
    protected $builder;

    /**
     * @param string $counterId
     */
    public function __construct(string $counterId)
    {
        $this->builder = new YandexMetrikaCounterBuilder($counterId);
    }

    /**
     * @return string
     */
    public function getPlacement(): string
    {
        return Meta::PLACEMENT_FOOTER;
    }

    /**
     * @param string $method
     * @param array $arguments
     *
     * @return YandexMetrika
     */
    public function __call($method, $arguments)
    {
        if (!method_exists($this->builder, $method)) {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s does not exist.',
                get_class($this->builder),
                $method
            ));
        }

        call_user_func_array([$this->builder, $method], $arguments);

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
        return (string)$this->builder;
    }
}
