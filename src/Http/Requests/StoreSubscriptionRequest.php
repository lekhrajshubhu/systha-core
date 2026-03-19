<?php

namespace Systha\Core\Http\Requests;

class StoreSubscriptionRequest extends ServiceRequestBaseRequest
{
    public function rules(): array
    {
        return array_merge($this->baseRules(), [
            'request_mode' => 'required|in:subscription',
            'start_date' => 'required|date',
            'frequency_unit' => 'required|in:week,month,year',
            'frequency_interval' => 'required|integer|min:1',
            'preferred_time_start' => 'nullable|date_format:H:i',
            'preferred_time_end' => 'nullable|date_format:H:i|after:preferred_time_start',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'recurring_amount' => 'required|numeric',
            'auto_generate_appointments' => 'nullable|boolean',
        ]);
    }
}
