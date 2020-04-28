<?php

namespace App\Main;

class Param
{
    private static $storage = [];

    public static function set($key, $value)
    {
        return self::$storage[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return (isset(self::$storage[$key])) ? self::$storage[$key] : $default;
    }

    public static function remove($key): bool
    {
        unset(self::$storage[$key]);
        return true;
    }

    public static function clean(): bool
    {
        self::$storage = [];
        return true;
    }
}