<?php

namespace Modules\Business\Entities;

use Modules\Core\Entities\Model;

class SalesExpert extends Model
{
    protected $guarded = ['id'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
