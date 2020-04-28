<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Main\Param;
use App\Main\Prepare;
use App\Main\Log;
use App\Parse\Aws;
use App\Storage\File\Csv;

/* set file for data from aws */
$file = __DIR__ . "/storage/KEYWORDWINNER_" . date('Y_d_m') . ".csv";

/* init const */
new Prepare();
/* init logs */
new Log();

/* parsing aws */
$storage = new Csv($file, Param::get('constant.aws.fields'));

$parser = new Aws($storage);
$parser->run(Param::get('constant.aws.keywords'));
