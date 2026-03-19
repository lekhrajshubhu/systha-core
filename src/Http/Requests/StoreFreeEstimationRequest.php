<?php

namespace Systha\Core\Http\Requests;

class StoreFreeEstimationRequest extends ServiceRequestBaseRequest
{
    public function rules(): array
    {
        return array_merge($this->baseRules(), [
            'request_mode' => 'required|in:free_estimation',
        ]);
    }
}
