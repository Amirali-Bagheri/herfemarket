<?php

namespace Modules\Category\Entities;

use Modules\Core\Entities\Model;

class Categorable extends Model
{
    protected $guarded =[];
    protected $table = 'categorables';
    public $timestamps = false;
}
