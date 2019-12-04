<?php

$settings = require ROOT.'/settings/config.php';

if (!function_exists('config')) {
    function config($key, $default = null)
    {
        global $settings;

        if (is_null($key)) {
            return $settings;
        }
        if (isset($settings[$key])) {
            return $settings[$key];
        }
        foreach (explode('.', $key) as $segment) {
            if (!is_array($settings) || !array_key_exists($segment, $settings)) {
                return value($default);
            }
            $settings = $settings[$segment];
        }
        return $settings;
    }
}


// created constants
foreach ($settings['const'] as $k => $v) {
    define($k, $v);
}
