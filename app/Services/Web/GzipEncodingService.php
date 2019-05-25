<?php

namespace App\Services\Web;

/**
 * Class GzipEncodingService
 * @package App\Services\Web
 */
class GzipEncodingService
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
     * @param bool $support
     */
    private function initResponseArray(bool $support = false): void
    {
        $this->responseArray = [
            "isSupported" => $support
        ];
    }

    /**
     * @return array
     */
    public function getResponseArray(): array
    {
        return $this->responseArray;
    }

    /**
     * @param string $errorMessage
     * @return GzipEncodingService
     */
    public function setResponseArrayError(string $errorMessage): GzipEncodingService
    {
        $this->responseArray["error"] = $errorMessage;
        return $this;
    }

    /**
     * AnalyzerController constructor.
     * @param string $header
     * @return array
     */
    public function gzipTest(string $header): array
    {
        $this->responseArray["isSupported"] = (strpos($header, "content-encoding: gzip")) ? true : false;
        return $this->responseArray;
    }
}
