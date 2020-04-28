<?php

namespace App\Parse\Traits;

use App\Main\Param;

trait AwsTrait
{

    protected function getPage(string $keyword)
    {
        $url = str_replace('{keyword}', urlencode($keyword), Param::get('constant.aws.url.for.parsing'));

        return file_get_html($url);
    }

    protected function getAdviserHeading($dom)
    {
        foreach ($dom->find('.s-shopping-adviser-heading') as $element) {
            if ($this->checkIsRecommendationPresent($element)) {
                return $element;
            }
        }

        return false;
    }

    protected function checkIsRecommendationPresent($dom): bool
    {
        $result = false;
        $elements = $dom->find('h3 span');

        foreach ($elements as $element) {
            if ($element->plaintext == 'Editorial recommendations') {
                $result = true;
                break;
            }
        }

        return $result;
    }

    protected function getCard($dom)
    {
        $domShop = $dom->parent();

        return $domShop->find('.a-carousel-container .a-carousel-row-inner .a-carousel-card')[0];
    }

    protected function getPublisherName($dom): string
    {
        $publisher = trim($dom->find('.a-row .a-link-normal')[0]->plaintext);

        return $publisher ?: "";
    }

    protected function getArticleName($dom): string
    {
        $article = strtoupper(trim($dom->find('.a-spacing-small .a-size-large')[0]->plaintext));

        return $article ?: "";
    }

    protected function getPublisherDate($dom): string
    {
        $date = trim($dom->find('.a-spacing-small .a-color-secondary')[0]->plaintext);

        if (stripos($date, '-')) {
            return trim(explode('-', $date)[0]);
        } else {
            return "";
        }
    }

    protected function getArticleUrl($dom): string
    {
        $url = $dom->find('.a-spacing-medium .a-link-normal')[0]->href;

        return $url ? Param::get('constant.aws.url') . $url : "";
    }

    protected function getCurrentDate(string $format = 'd F Y, H:i:s'): string
    {
        return date($format);
    }
}