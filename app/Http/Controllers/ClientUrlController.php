<?php

namespace App\Http\Controllers;

use App\Traits\ClientUrlTrait;
use Illuminate\Http\Request;

/**
 * Class ClientUrlController
 * @package App\Http\Controllers
 */
class ClientUrlController extends Controller
{
    use ClientUrlTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function body(Request $request): array
    {
        $url = $request->input('url');
        return $this->retrieveCurlResponse(
            $this->composeBodyOptionsArray($url)
        );
    }

    /**
     * @param Request $request
     * @return array
     */
    public function header(Request $request): array
    {
        $url = $request->input('url');
        return $this->retrieveCurlResponse(
            $this->composeHeaderOptionsArray($url)
        );
    }
}
