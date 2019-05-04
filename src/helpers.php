<?php

use Soumen\Setting\Setting;

if (!function_exists('setting')) {

    /**
     * Fetch the specified setting, if given no params returns the Soumen\Setting\Setting instance.
     *
     * @param Array | String | Null $key
     * @return Mixed
     */
    function setting($key = null, $value = null)
    {
        $setting = new Setting;

        if (!is_null($value)) {
            // set the setting value
            $setting->set($key, $value);
        }

        if (is_array($key)) {
            // set the setting value
            $settingKey = array_keys($key)[0];

            return $setting->set($settingKey, $key[$settingKey]);
        }

        if (is_null($key)) {
            // return the Setting instance
            return $setting;
        }

        return $setting->get($key);
    }

}