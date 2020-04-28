<?php

namespace App\Storage\File;

class File {

    protected static $file;
    protected static $fileOpen;

    public function __construct(string $file)
    {
        static::$file = $file;

        static::init();
    }

    public function __destruct()
    {
        fclose(static::$fileOpen);
    }

    public static function init()
    {
        if (file_exists(static::$file)) {
            file_put_contents (static::$file, "");
        }

        static::$fileOpen = fopen(self::$file,"w");
    }
}
