<?php

namespace Systha\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class ServiceRequestBaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function baseRules(): array
    {
        return [
            'tenant_id' => 'required|exists:svc_tenants,id',
            'tenant_customer_id' => 'required|exists:svc_tenant_customers,id',
            'service_item_id' => 'required|exists:svc_service_items,id',
            'created_by_member_id' => 'nullable|exists:svc_tenant_members,id',
            'request_mode' => 'required|in:free_estimation,inspection,schedule_service,subscription',
            'status' => 'nullable|in:draft,submitted,in_progress,completed,cancelled',
            'service_title' => 'required|string|max:255',
            'base_price' => 'nullable|numeric',
            'total_adjustment' => 'nullable|numeric',
            'final_amount' => 'nullable|numeric',
            'currency' => 'nullable|string|size:3',
            'customer_notes' => 'nullable|string',
            'internal_notes' => 'nullable|string',
            'raw_answers' => 'nullable|array',
            'pricing_snapshot' => 'nullable|array',
            'submitted_at' => 'nullable|date',
        ];
    }
}
