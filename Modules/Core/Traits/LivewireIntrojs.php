<?php

namespace Modules\Core\Traits;

trait LivewireIntrojs
{
    protected function getListeners()
    {
        return ['completed_steps' => 'completedSteps'];
    }

    public function completedSteps()
    {
        \Cookie::forever('first_time_login', true);
    }
}
