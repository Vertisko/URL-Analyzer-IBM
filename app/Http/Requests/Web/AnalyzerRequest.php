<?php

namespace App\Http\Requests\Web;

use App\Http\Requests\BaseRequest;

/**
 * Class AnalyzerRequest
 * @package App\Http\Requests\Web
 */
class AnalyzerRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(
            validateService()->urlValidation()
        );
    }
}
