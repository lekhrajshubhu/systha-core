<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'svc_customer_requests';

    protected $fillable = [
        'tenant_id',
        'tenant_customer_id',
        'service_item_id',
        'created_by_member_id',
        'request_mode',
        'status',
        'service_title',
        'base_price',
        'total_adjustment',
        'final_amount',
        'currency',
        'customer_notes',
        'internal_notes',
        'raw_answers',
        'pricing_snapshot',
        'submitted_at',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'total_adjustment' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'raw_answers' => 'array',
        'pricing_snapshot' => 'array',
        'submitted_at' => 'datetime',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function tenantCustomer(): BelongsTo
    {
        return $this->belongsTo(TenantCustomer::class, 'tenant_customer_id');
    }

    public function createdByMember(): BelongsTo
    {
        return $this->belongsTo(TenantMember::class, 'created_by_member_id');
    }

    public function serviceItem(): BelongsTo
    {
        return $this->belongsTo(ServiceItem::class, 'service_item_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(CustomerRequestAnswer::class, 'request_id');
    }

    public function freeEstimation(): HasOne
    {
        return $this->hasOne(FreeEstimation::class, 'request_id');
    }

    public function inspection(): HasOne
    {
        return $this->hasOne(Inspection::class, 'request_id');
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class, 'request_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'request_id');
    }

    public function tenantQuotes(): HasMany
    {
        return $this->hasMany(RequestTenantQuote::class, 'request_id');
    }
}
