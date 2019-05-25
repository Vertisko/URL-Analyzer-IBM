<?php

namespace App\Services\Web;

use App\Traits\ClientUrlTrait;
use RobotsTxtParser;
use vipnytt\XRobotsTagParser;

/**
 * Class IndexService
 * @package App\Services\Web
 */
class IndexService
{
    use ClientUrlTrait;

    private $responseArray;

    /**
     * IndexService constructor.
     */
    public function __construct()
    {
        $this->initResponseArray();
    }


    /**
     * @return void
     */
    private function initResponseArray(): void
    {
        $this->responseArray = [
            "robotsFile" => array(), "metaTag" => array(), "xRobotTag" => array()
        ];
    }

    /**
     * @param bool $exists
     * @param bool $isIndexed
     * @return array
     */
    private function initPartArray(bool $exists = false, bool $isIndexed = true): array
    {
        return ["exists" => $exists, "isIndexed" => $isIndexed];
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
     * @return IndexService
     */
    public function setResponseArrayError(string $errorMessage): IndexService
    {
        $this->responseArray["error"] = $errorMessage;
        return $this;
    }


    /**
     * @param string $header
     * @param string $url
     * @return array
     */
    public function indexTest(string $header, string $url): array
    {
        $this->initResponseArray();
        $this->lookupMetaTag($url);
        $this->lookupRobotsFile($url);
        $this->lookupXRobotTag($header);

        return $this->getResponseArray();
    }

    /**
     * @param string $header
     */
    private function lookupXRobotTag(string $header)
    {
        $result = $this->initPartArray();
        $result["exists"] = (stripos($header, "X-Robots-Tag")) ? true : false;
        $rules = $this->retrieveXRobotRules($header);
        //         rules for agent * found
        if (!empty($rules)) {
            if (isset($rules['noindex'])) {
                $result["isIndexed"] = !$rules['noindex'];
            }
        }
        $this->responseArray["xRobotTag"] = $result;
    }

    /**
     * @param string $header
     * @return array
     */
    private function retrieveXRobotRules(string $header): array
    {
        $parser = new XRobotsTagParser\Adapters\TextString($header, '*');
        return $parser->getRules();
    }

    /**
     * @param string $url
     */
    private function lookupRobotsFile(string $url): void
    {
        $result = $this->initPartArray();
        $robotsFileBody = $this->retrieveCurlResponse($this->composeBodyOptionsArray("$url/robots.txt"));
//         robots.txt file found
        if ($robotsFileBody["statusCode"] == 200) {
            $result = $this->robotTsFileIndexTest($result, $robotsFileBody["response"], '*');
        }
        $this->responseArray["robotsFile"] = $result;
    }

    /**
     * @param array $result
     * @param string $robotsFileBody
     * @param string $agent
     * @return array
     */
    private function robotTsFileIndexTest(array $result, string $robotsFileBody, string $agent): array
    {
        $result["exists"] = true;
        $parser = new RobotsTxtParser($robotsFileBody);
        $parser->setUserAgent($agent);
        $result["isIndexed"] = $parser->isAllowed('/') ? true : false;
        return $result;
    }

    /**
     * @param string $url
     */
    private function lookupMetaTag(string $url): void
    {
        $result = $this->initPartArray();
        $tags = get_meta_tags($this->enforceHttpsProtocol($url));
//        meta tag found
        if (isset($tags["robots"])) {
            $result["exists"] = true;
            $result["isIndexed"] = (stripos($tags["robots"], "noindex")) ? false : true;
        }
        $this->responseArray["metaTag"] = $result;
    }
}
