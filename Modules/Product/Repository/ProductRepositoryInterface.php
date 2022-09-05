<?php

namespace Modules\Product\Repository;

use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function all(): Collection;

    public function deleteFull($id);
}
