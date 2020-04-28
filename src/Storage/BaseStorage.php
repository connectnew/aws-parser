<?php

namespace App\Storage;

interface BaseStorage
{
    public function addRow(array $data): bool;
}
