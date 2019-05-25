<?php

namespace App\Services\Web;

use DOMDocument;

/**
 * Class ImageAltService
 * @package App\Services\Web
 */
class ImageAltService
{
    private $responseArray;

    /**
     * AnalyzerController constructor.
     */
    public function __construct()
    {
        $this->initResponseArray();
    }

    /**
     * @param int $without
     * @param int $with
     */
    private function initResponseArray(int $without = 0, int $with = 0): void
    {
        $this->responseArray = [
            "without" => $without,
            "with" => $with
        ];
    }

    /**
     * @param string $body
     * @return array
     */
    public function altsComputation(string $body): array
    {
        $this->initResponseArray();
        $domNodes = $this->domInitializer($body);
        return $this->computeExactNumbers($domNodes);
    }

    /**
     * @param string $htmlContent
     * @return \DOMNodeList
     */
    private function domInitializer(string $htmlContent): \DOMNodeList
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($htmlContent);
        return $dom->getElementsByTagName("img");
    }

    /**
     * @param \DOMNodeList $images
     * @return array
     */
    private function computeExactNumbers(\DOMNodeList $images): array
    {
        foreach ($images as $image) {
            (!$image->hasAttribute("alt") || empty($image->getAttribute("alt"))) ?
                $this->responseArray["without"]++
                :
                $this->responseArray["with"]++;
        }
        return $this->responseArray;
    }
}
