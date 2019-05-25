<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class ImageWebPController
 * @package App\Http\Controllers
 */
class ImageWebPController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function webPTest(Request $request): array
    {
        $body = $request->input('body');
        return imageWebPService()->webPTest($body);
    }
}
