<?php

namespace Modules\Seo\Contracts;

interface WithDependencies
{
    /**
     * @return array
     */
    public function getDependencies(): array;

    /**
     * @return bool
     */
    public function hasDependencies();
}
