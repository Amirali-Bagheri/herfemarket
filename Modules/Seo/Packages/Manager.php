<?php

namespace Modules\Seo\Packages;

use Closure;
use Illuminate\Support\Collection;
use Modules\Seo\Contracts\Packages\ManagerInterface;
use Modules\Seo\Contracts\Packages\PackageInterface;

class Manager implements ManagerInterface
{
    /**
     * @var Collection
     */
    protected $packages;

    public function __construct()
    {
        $this->packages = new Collection();
    }

    /**
     * @inheritdoc
     */
    public function create(string $name, Closure $callback = null)
    {
        $this->register($package = new Package($name));

        if ($callback) {
            $callback->__invoke($package);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function register(PackageInterface $package)
    {
        $this->packages->put($package->getName(), $package);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPackages(): array
    {
        return $this->packages->all();
    }

    /**
     * @inheritdoc
     */
    public function getPackage(string $name): ?PackageInterface
    {
        return $this->packages->get($name);
    }
}
