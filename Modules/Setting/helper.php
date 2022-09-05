<?php

use Modules\Setting\Entities\Setting;

if (!function_exists('setting')) {
    function setting($key)
    {
        try {
            return Setting::get($key);
        } catch (Throwable $ex) {
            return null;
        }
    }
}

if (!function_exists('setting_set')) {
    function setting_set($key, $value)
    {
        return Setting::set($key, $value);
    }
}
