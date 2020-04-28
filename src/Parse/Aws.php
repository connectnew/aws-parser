<?php

namespace App\Parse;

use App\Storage\BaseStorage;
use App\Parse\Traits\AwsTrait;
use App\Main\Log;
use Exception;

class Aws implements BaseParse
{
    use AwsTrait;

    protected $store;

    public function __construct(BaseStorage $store)
    {
        $this->store = $store;
    }

    public function run(array $keywords): void
    {
        $success = true;
        foreach ($keywords as $key) {
            try {
                $this->runItem($key);
            } catch (Exception $e) {
                $success = false;
                Log::error($e->getMessage());
            }
        }

        if ($success) {
            Log::info('Success: AWS has been parsed!');
        }
    }

    protected function runItem(string $keyword): void
    {
        $dom = $this->getPage($keyword);

        $domHead = $this->getAdviserHeading($dom);
        if ($domHead) {

            $domCard = $this->getCard($domHead);

            $result['Publisher'] = $this->getPublisherName($domHead);
            $result['Article name'] = $this->getArticleName($domCard);
            $result['Publish date'] = $this->getPublisherDate($domCard);
            $result['Article URL'] = $this->getArticleUrl($domCard);
            $result['Scraping date'] = $this->getCurrentDate();

            $this->save($result);
        } else {
            Log::notice("AWS parser: For { $keyword } not found recommended products");
        }
    }

    public function save(array $data): void
    {
        $this->store->addRow($data);
    }
}
