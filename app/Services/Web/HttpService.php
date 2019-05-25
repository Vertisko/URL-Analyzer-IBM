<?php

namespace App\Services\Web;

/**
 * Class HttpService
 * @package App\Services\Web
 */
class HttpService
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
     * @param string $error
     */
    private function initResponseArray(bool $support = false, string $error = ""): void
    {
        $this->responseArray = [
            "isSupported" => $support,
            "error" => $error
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
     * @return HttpService
     */
    public function setResponseArrayError(string $errorMessage): HttpService
    {
        $this->responseArray["error"] = $errorMessage;
        return $this;
    }

    /**
     * @param string $header
     * @return array
     */
    public function httpTest(string $header): array
    {
        $this->evaluateClientSideTest() ?
            $this->evaluateServerSideTest($header) :
            $this->setResponseArrayError("Client does not support HTTP2");

        return $this->getResponseArray();
    }


    /**
     * @return bool
     */
    public function evaluateClientSideTest(): bool
    {
        return (curl_version()["features"] & CURL_VERSION_HTTP2 !== 0) ? true : false;
    }

    /**
     * @param string $header
     * @return array
     */
    private function evaluateServerSideTest(string $header): array
    {
        $header !== false ?
            ($this->responseArray["isSupported"] = (strpos($header, "HTTP/2") === 0) ? true : false)
            :
            $this->setResponseArrayError("Curl response error");

        return $this->responseArray;
    }
}
