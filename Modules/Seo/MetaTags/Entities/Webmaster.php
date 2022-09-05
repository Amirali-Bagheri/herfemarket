<?php

namespace Modules\Seo\MetaTags\Entities;

use InvalidArgumentException;

class Webmaster extends Tag
{
    public const GOOGLE = 'google';
    public const YANDEX = 'yandex';
    public const PINTEREST = 'pinterest';
    public const ALEXA = 'alexa';
    public const BING = 'bing';

    /**
     * The supported webmasters.
     *
     * @var array
     */
    protected $services = [
        Webmaster::YANDEX => 'yandex-verification',
        Webmaster::GOOGLE => 'google-site-verification',
        Webmaster::PINTEREST => 'p:domain_verify',
        Webmaster::ALEXA => 'alexaVerifyID',
        Webmaster::BING => 'msvalidate.01',
    ];

    /**
     * @param string $service
     * @param string $content
     */
    public function __construct(string $service, string $content)
    {
        parent::__construct('meta', [
            'name' => $this->getServiceName($service),
            'content' => $content,
        ]);
    }

    /**
     * @param string $service
     *
     * @return string
     */
    protected function getServiceName(string $service): string
    {
        if (!isset($this->services[$service])) {
            throw new InvalidArgumentException('Webmaster service is not supported.');
        }

        return $this->services[$service];
    }
}
