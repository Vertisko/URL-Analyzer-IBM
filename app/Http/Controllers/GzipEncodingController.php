<?php

namespace App\Http\Controllers;

use App\Traits\ClientUrlTrait;
use Illuminate\Http\Request;

/**
 * Class GzipEncodingController
 * @package App\Http\Controllers
 */
class GzipEncodingController extends Controller
{
    use ClientUrlTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function gzipTest(Request $request): array
    {
        $url = $request->input('url');
        $header = $this->retrieveCurlResponse($this->composeHeaderOptionsArray($url));
        return gzipEncodingService()->gzipTest($header["response"]);
    }
}
