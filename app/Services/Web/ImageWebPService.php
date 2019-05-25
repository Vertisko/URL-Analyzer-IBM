<?php

namespace App\Services\Web;

use DOMDocument;

/**
 * Class ImageWebPService
 * @package App\Services\Web
 */
class ImageWebPService
{
    const TYPE_IMAGE_WEB_P = "image/webp";
    private $responseArray;

    /**
     * AnalyzerController constructor.
     */
    public function __construct()
    {
        $this->initResponseArray();
    }

    /**
     * @param bool $support
     */
    private function initResponseArray(bool $support = false): void
    {
        $this->responseArray = [
            "isSupported" => $support
        ];
    }

    /**
     * @param string $body
     * @return array
     */
    public function webPTest(string $body): array
    {
        $this->initResponseArray();
        $domNodes = $this->domInitializer($body);
        return $this->detectWebPFiles($domNodes);
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
        return $dom->getElementsByTagName("source");
    }

    /**
     * @param \DOMNodeList $sources
     * @return array
     */
    private function detectWebPFiles(\DOMNodeList $sources): array
    {
        foreach ($sources as $source) {
            if ($source->hasAttribute("type") && !empty($source->getAttribute("type"))) {
                $type = $source->getAttribute("type");
                if ($type == $this::TYPE_IMAGE_WEB_P) {
                    $this->responseArray["isSupported"] = true;
                    break;
                }
            }
        }
        return $this->responseArray;
    }
}
