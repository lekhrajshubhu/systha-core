<?php

namespace Systha\Core\Http\Requests;

class StoreInspectionRequest extends ServiceRequestBaseRequest
{
    public function rules(): array
    {
        return array_merge($this->baseRules(), [
            'request_mode' => 'required|in:inspection',
        ]);
    }
}
