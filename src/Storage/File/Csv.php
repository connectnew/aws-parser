<?php

namespace App\Storage\File;

use App\Main\Log;
use App\Storage\BaseStorage;
use Exception;

class Csv extends File implements BaseStorage
{
    protected static $fields;

    public function __construct(string $file, array $fields)
    {
        parent::__construct($file);

        static::$fields = $fields;

        $this->addRow(static::$fields);
    }

    public function addRow(array $data): bool
    {
        $result = true;
        if (count(static::$fields) === count($data)) {
            try {
                fputcsv(self::$fileOpen, $data);
            } catch (Exception $e) {
                $result = false;
                Log::error($e->getMessage());
            }
        } else {
            throw new Exception('Error: Input data are different from file head!');
        }

        return $result;
    }

}