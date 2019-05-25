<?php

namespace App\Http\Controllers;

use App\Traits\ClientUrlTrait;
use Illuminate\Http\Request;

/**
 * Class HttpController
 * @package App\Http\Controllers
 */
class HttpController extends Controller
{
    use ClientUrlTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function httpTest(Request $request): array
    {
        $url = $request->input('url');

        $header = $this->retrieveCurlResponse(
            $this->composeHeaderOptionsArray($url)
        );
        return httpService()->httpTest($header["response"]);
    }
}
