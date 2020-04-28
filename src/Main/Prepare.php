<?php

namespace App\Main;

class Prepare
{
    public function __construct()
    {
        static::initConfig();
        static::initLog();

        date_default_timezone_set(Param::get('constant.timezone'));
    }

    public static function initConfig()
    {
        $constant = require_once __DIR__ . "/../../config/constant.php";

        Param::set('constant.timezone', $constant['timezone']);
        Param::set('constant.aws.url', $constant['aws']['url']);
        Param::set('constant.aws.url.for.parsing', $constant['aws']['urlForParcing']);
        Param::set('constant.aws.fields', $constant['aws']['fields']);
        Param::set('constant.aws.keywords', $constant['aws']['keywords']);

        Param::set('constant', $constant);
    }

    public static function initLog()
    {
        $logInfo = __DIR__ . "/../../storage/log_info.log";
        $logNotice = __DIR__ . "/../../storage/log_notice.log";
        $logWarning = __DIR__ . "/../../storage/log_warning.log";
        $logError = __DIR__ . "/../../storage/log_error.log";

        Param::set('log.info', $logInfo);
        Param::set('log.notice', $logNotice);
        Param::set('log.warning', $logWarning);
        Param::set('log.error', $logError);
    }
}