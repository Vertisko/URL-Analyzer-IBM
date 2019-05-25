<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\AnalyzerRequest;
use App\Http\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class AnalyzerController
 * @package App\Http\Controllers
 */
class AnalyzerController extends Controller
{
    /**
     * @return View
     */
    public function intro(): View
    {
        return view('analyzer');
    }

    /**
     * @param AnalyzerRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|View
     */
    public function analyze(AnalyzerRequest $request)
    {
        $analysis = analyzerService()->analyze($request);

        if (empty($analysis)) {
            return back()->withErrors([trans('content.something_went_wrong')])
                ->withInput();
        } else {
            return view('analyzer', [
                'result' => $analysis
            ]);
        }
    }

    /**
     * @param AnalyzerRequest $request
     * @return JsonResponse
     */
    public function analyzeJson(AnalyzerRequest $request): JsonResponse
    {
        return ResponseFactory::createSuccessfulResponse(analyzerService()->analyze($request));
    }
}
