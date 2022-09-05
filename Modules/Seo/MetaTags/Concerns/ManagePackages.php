<?php

namespace Modules\Seo\MetaTags\Concerns;

use Modules\Seo\Contracts\MetaTags\PlacementsInterface;
use Modules\Seo\Contracts\Packages\PackageInterface;
use Modules\Seo\Contracts\WithDependencies;

trait ManagePackages
{
    /**
     * @var array
     */
    private $packages = [];

    /**
     * @var array
     */
    private $registeredPackages = [];

    /**
     * @inheritdoc
     */
    public function registerPackage(PackageInterface $package)
    {
        $name = $package->getName();

        if ($this->isRegisteredPackage($name)) {
            return $this;
        }

        $this->registeredPackages[] = $name;

        if ($package instanceof WithDependencies) {
            $this->includePackages(
                $package->getDependencies()
            );
        }

        if ($package instanceof PlacementsInterface) {
            foreach ($package->getPlacements() as $placement => $tags) {
                $this->registerTags($tags, $placement);
            }
        }

        $this->registerTags(
            $package->getTags()
        );

        return $this;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    protected function isRegisteredPackage(string $name): bool
    {
        return in_array($name, $this->registeredPackages);
    }

    /**
     * @inheritdoc
     */
    public function includePackages($packages)
    {
        $packages = is_array($packages) ? $packages : func_get_args();

        foreach ($packages as $package) {
            if ($package = $this->packageManager->getPackage($package)) {
                $this->registerPackage($package);
            }
        }

        return $this;
    }
}
