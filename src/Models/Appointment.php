<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'svc_appointments';

    protected $fillable = [
        'tenant_id',
        'request_id',
        'subscription_id',
        'tenant_customer_id',
        'assigned_member_id',
        'service_address_id',
        'appointment_type',
        'appointment_date',
        'time_start',
        'time_end',
        'timezone',
        'status',
        'access_notes',
        'confirmed_at',
        'started_at',
        'completed_at',
        'cancelled_at',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'confirmed_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(CustomerRequest::class, 'request_id');
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function tenantCustomer(): BelongsTo
    {
        return $this->belongsTo(TenantCustomer::class, 'tenant_customer_id');
    }

    public function assignedMember(): BelongsTo
    {
        return $this->belongsTo(TenantMember::class, 'assigned_member_id');
    }

    public function serviceAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'service_address_id');
    }
}
