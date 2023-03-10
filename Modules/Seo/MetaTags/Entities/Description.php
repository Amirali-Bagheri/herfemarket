<?php

namespace Modules\Seo\MetaTags\Entities;

class Description extends Tag
{
    use Concerns\ManageMaxLength;

    public const DEFAULT_LENGTH = null;

    /**
     * @var string
     */
    protected $description;

    /**
     * @param string $description
     * @param int $maxLength
     */
    public function __construct(string $description, int $maxLength = self::DEFAULT_LENGTH)
    {
        parent::__construct('meta', []);

        $this->description = $description;
        $this->setMaxLength($maxLength);
    }

    /**
     * @return array
     */
    protected function getAttributes(): array
    {
        return array_merge([
            'name' => 'description',
            'content' => $this->limitString($this->description),
        ], parent::getAttributes());
    }
}
