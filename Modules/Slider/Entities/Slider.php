<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Kyslik\ColumnSortable\Sortable;
use Modules\Core\Entities\Model;

class Slider extends Model
{
    protected $guarded = ['id'];

    public function slides()
    {
        return $this->hasMany(Slides::class);
    }
}
