<?php

namespace App\Main;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log {

    public static $log;

    public function __construct()
    {
        $log = new Logger('main');

        $log->pushHandler(new StreamHandler(Param::get('log.info'), Logger::INFO));
        $log->pushHandler(new StreamHandler(Param::get('log.notice'), Logger::NOTICE));
        $log->pushHandler(new StreamHandler(Param::get('log.error'), Logger::ERROR));
        $log->pushHandler(new StreamHandler(Param::get('log.warning'), Logger::WARNING));

        static::$log = $log;
    }

    public static function info(string $message): void
    {
        static::$log->info($message);
    }

    public static function notice(string $message): void
    {
        static::$log->notice($message);
    }

    public static function warning(string $message): void
    {
        static::$log->warning($message);
    }

    public static function error(string $message): void
    {
        static::$log->error($message);
    }
}
