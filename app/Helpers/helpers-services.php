<?php


if (!function_exists('analyzerService')) {
    function analyzerService()
    {
        static $service = null;
        if (null === $service) {
            $service = new  \App\Services\Web\AnalyzerService();
        }
        return $service;
    }
}

if (!function_exists('gzipEncodingService')) {
    function gzipEncodingService()
    {
        static $service = null;
        if (null === $service) {
            $service = new \App\Services\Web\GzipEncodingService();
        }
        return $service;
    }
}

if (!function_exists('httpService')) {
    function httpService()
    {
        static $service = null;
        if (null === $service) {
            $service = new \App\Services\Web\HttpService();
        }
        return $service;
    }
}


if (!function_exists('imageAltService')) {
    function imageAltService()
    {
        static $service = null;
        if (null === $service) {
            $service = new \App\Services\Web\ImageAltService();
        }
        return $service;
    }
}


if (!function_exists('imageWebPService')) {
    function imageWebPService()
    {
        static $service = null;
        if (null === $service) {
            $service = new \App\Services\Web\ImageWebPService();
        }
        return $service;
    }
}


if (!function_exists('indexService')) {
    function indexService()
    {
        static $service = null;
        if (null === $service) {
            $service = new \App\Services\Web\IndexService();
        }
        return $service;
    }
}

if (!function_exists('pageSpeedInsightService')) {
    function pageSpeedInsightService()
    {
        static $service = null;
        if (null === $service) {
            $service = new \App\Services\Web\PageSpeedInsightService();
        }
        return $service;
    }
}


if (!function_exists('validateService')) {
    function validateService()
    {
        static $service = null;
        if (null === $service) {
            $service = new \App\Services\Validation\ValidateService();
        }
        return $service;
    }
}
