<?php

namespace App\Http\Controllers;

use App\Traits\ClientUrlTrait;
use Illuminate\Http\Request;

/**
 * Class ImageAltController
 * @package App\Http\Controllers
 */
class ImageAltController extends Controller
{
    use ClientUrlTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function altsComputation(Request $request): array
    {
        $url = $request->input('url');
        $body = $this->retrieveCurlResponse($this->composeBodyOptionsArray($url));
        return imageAltService()->altsComputation($body["response"]);
    }
}
