<?php

namespace Modules\Seo\MetaTags\Entities;

use Modules\Seo\Contracts\MetaTags\Entities\TagInterface;
use Modules\Seo\MetaTags\Meta;

class GoogleTagManager implements TagInterface
{
    /**
     * Google analytics identifier
     *
     * @var string
     */
    private $counterId;

    /**
     * @param string $counterId Google analytics identifier
     */
    public function __construct(string $counterId)
    {
        $this->counterId = $counterId;
    }

    /**
     * @inheritDoc
     */
    public function getPlacement(): string
    {
        return Meta::PLACEMENT_HEAD;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toHtml();
    }

    /**
     * @inheritDoc
     */
    public function toHtml()
    {
        return sprintf(
            <<<TAG
<script async src="https://www.googletagmanager.com/gtag/js?id=%s"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '%s');
</script>
TAG
            ,
            $this->counterId,
            $this->counterId
        );
    }
}
