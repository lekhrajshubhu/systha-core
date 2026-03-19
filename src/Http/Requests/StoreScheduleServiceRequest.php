<?php

namespace Systha\Core\Http\Requests;

class StoreScheduleServiceRequest extends ServiceRequestBaseRequest
{
    public function rules(): array
    {
        return array_merge($this->baseRules(), [
            'request_mode' => 'required|in:schedule_service',
            'appointment_date' => 'required|date',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'nullable|date_format:H:i|after:time_start',
            'timezone' => 'required|string|max:100',
        ]);
    }
}
