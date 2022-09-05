<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model
{
    // use  Sortable;

    public $sortable = [
        'id',
        'name',
        'mobile',
        'email',
        'subject',
        'created_at',
    ];
    public $fillable = ['name', 'subject', 'mobile', 'email', 'message'];

    public function showType()
    {
        switch ($this->attributes['type']) {
            case 'contact':
                return 'تماس با ما';
                break;
            case 'feedback':
                return 'انتقادات و پیشنهادات';
                break;
            default:
                return '-';
        }
    }
}
