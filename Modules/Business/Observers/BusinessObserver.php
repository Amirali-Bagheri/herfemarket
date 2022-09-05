<?php

namespace Modules\Business\Observers;

use Modules\Business\Entities\Business;

class BusinessObserver
{
    public function updating(Business $business)
    {
//        if($business->isDirty('name')){
//            // email has changed
//            $new_email = $business->email;
//            $old_email = $business->getOriginal('email');
//        }
    }
}
