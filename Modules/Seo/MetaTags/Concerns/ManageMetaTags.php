<?php

namespace Modules\Seo\MetaTags\Concerns;

use Illuminate\Support\Facades\Session;
use Modules\Seo\Contracts\MetaTags\Entities\TagInterface;
use Modules\Seo\Contracts\MetaTags\GeoMetaInformationInterface;
use Modules\Seo\Contracts\MetaTags\RobotsTagsInterface;
use Modules\Seo\Contracts\MetaTags\SeoMetaTagsInterface;
use Modules\Seo\MetaTags\Entities\Description;
use Modules\Seo\MetaTags\Entities\Keywords;
use Modules\Seo\MetaTags\Entities\Tag;
use Modules\Seo\MetaTags\Entities\Webmaster;

trait ManageMetaTags
{
    /**
     * @inheritdoc
     */
    public function setMetaFrom($object)
    {
        if ($object instanceof SeoMetaTagsInterface) {
            $this->setTitle($object->getTitle())
                ->setDescription($object->getDescription())
                ->setKeywords($object->getKeywords());
        }

        if ($object instanceof RobotsTagsInterface) {
            $this->setRobots($object->getRobots());
        }

        if ($object instanceof GeoMetaInformationInterface) {
            $this->setGeo($object);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setKeywords($keywords, int $maxLength = null)
    {
        if (!is_array($keywords)) {
            $keywords = [$keywords];
        }

        if (is_null($maxLength)) {
            $maxLength = config('seo.keywords.max_length');
        }

        $keywords = array_map(function ($keyword) {
            return $this->cleanString($keyword);
        }, $keywords);

        return $this->addTag('keywords', new Keywords($keywords, $maxLength));
    }

    /**
     * @inheritdoc
     */
    public function setDescription(?string $description, int $maxLength = null)
    {
        if (is_null($maxLength)) {
            $maxLength = config('seo.description.max_length');
        }

        return $this->addTag(
            'description',
            new Description(
            $this->cleanString($description),
            $maxLength
        )
        );
    }

    /**
     * @inheritdoc
     */
    public function setRobots(?string $behavior)
    {
        return $this->addMeta('robots', [
            'content' => $this->cleanString($behavior),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function addMeta(string $name, array $attributes, bool $checkNameAttribute = true)
    {
        if ($checkNameAttribute && !isset($attributes['name'])) {
            $attributes = array_merge(['name' => $name], $attributes);
        }

        return $this->addTag($name, Tag::meta($attributes));
    }

    /**
     * @inheritdoc
     */
    public function setGeo(GeoMetaInformationInterface $geo)
    {
        $this->addMeta('geo.position', [
            'content' => $this->cleanString($geo->latitude() . '; ' . $geo->longitude()),
        ]);

        if ($placename = $geo->placename()) {
            $this->addMeta('geo.placename', [
                'content' => $placename,
            ]);
        }

        if ($region = $geo->region()) {
            $this->addMeta('geo.region', [
                'content' => $region,
            ]);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDescription(): ?TagInterface
    {
        return $this->getTag('description');
    }

    /**
     * @inheritdoc
     */
    public function getKeywords(): ?TagInterface
    {
        return $this->getTag('keywords');
    }

    /**
     * @inheritdoc
     */
    public function getRobots(): ?TagInterface
    {
        return $this->getTag('robots');
    }

    /**
     * @inheritdoc
     */
    public function setContentType(string $type, string $charset = 'utf-8')
    {
        return $this->addMeta('content_type', [
            'http-equiv' => 'Content-Type',
            'content' => $this->cleanString($type . '; charset=' . $charset),
        ], false);
    }

    /**
     * @inheritdoc
     */
    public function getContentType(): ?TagInterface
    {
        return $this->getTag('content_type');
    }

    /**
     * @inheritdoc
     */
    public function setCharset(string $charset = 'utf-8')
    {
        return $this->addMeta('charset', [
            'charset' => $charset,
        ], false);
    }

    /**
     * @inheritdoc
     */
    public function getCharset(): ?TagInterface
    {
        return $this->getTag('charset');
    }

    /**
     * @inheritdoc
     */
    public function setViewport(string $viewport)
    {
        return $this->addMeta('viewport', [
            'content' => $this->cleanString($viewport),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getViewport(): ?TagInterface
    {
        return $this->getTag('viewport');
    }

    /**
     * @inheritdoc
     */
    public function addCsrfToken()
    {
        return $this->addMeta('csrf-token', [
            'content' => Session::token(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function addWebmaster(string $service, string $content)
    {
        return $this->addTag('webmaster.' . $service, new Webmaster(
            $service,
            $content
        ));
    }
}
