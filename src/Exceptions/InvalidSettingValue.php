<?php

namespace Soumen\Setting\Exceptions;

use Exception;

class InvalidSettingValue extends Exception
{
    public static function create($setting)
    {
        if (is_null($setting)) {
            return new static("Setting 'key' or 'value' cannot be null.");
        }

        return new static("Invalid 'key' or 'value' given for the setting.");
    }
}
