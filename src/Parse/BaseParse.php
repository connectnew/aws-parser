<?php

namespace App\Parse;

use App\Storage\BaseStorage;

include_once __DIR__ . '/../lib/simple_html_dom.php';

interface BaseParse
{
    public function __construct(BaseStorage $store);

    public function run(array $url): void;

    public function save(array $data): void;
}
