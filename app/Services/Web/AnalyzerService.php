<?php


namespace App\Services\Web;

use App\Traits\ClientUrlTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AnalyzerService
 * @package App\Services\Web
 */
class AnalyzerService
{
    use ClientUrlTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function analyze(Request $request): array
    {
        $url = $request->input('url');
        $body = $this->retrieveCurlResponse($this->composeBodyOptionsArray($url));
        $header = $this->retrieveCurlResponse($this->composeHeaderOptionsArray($url));
        $result = [];
        if ($body["statusCode"] <> JsonResponse::HTTP_OK) {
            return $result;
        }
        //1. status code
        $result["statusCode"] = $body["statusCode"];
        //2. http2.0 test
        $result["httpTest"] = httpService()->httpTest($header["response"]);
        //3. gzip test
        $result["gzipTest"] = gzipEncodingService()->gzipTest($header["response"]);
        //4. image/webP test
        $result["webPTest"] = imageWebPService()->webPTest($body["response"]);
        //5. index test
        $result["indexTest"] = indexService()->indexTest($header["response"], $url);
        //6. image alts test
        $result["imageAltsTest"] = imageAltService()->altsComputation($body["response"]);

        //7. page speed insight analysis output
        $result["insight"] = pageSpeedInsightService()->insightAnalysisReview($url);

        return $result;
    }
}
