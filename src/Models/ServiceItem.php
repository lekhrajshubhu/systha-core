<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceItem extends Model
{
    use HasFactory;

    protected $table = 'svc_service_items';

    protected $fillable = [
        'service_group_id',
        'service_type_id',
        'name',
        'slug',
        'meta',
        'outcome_type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'meta' => 'array',
    ];

    public function serviceGroup(): BelongsTo
    {
        return $this->belongsTo(ServiceGroup::class, 'service_group_id');
    }

    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    public function directQuestions(): HasMany
    {
        return $this->hasMany(Question::class, 'service_item_id');
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(
            Question::class,
            'svc_service_item_questions',
            'service_item_id',
            'question_id'
        )->withPivot(['sort_order', 'is_start'])->withTimestamps();
    }

    public function serviceItemQuestions(): HasMany
    {
        return $this->hasMany(ServiceItemQuestion::class, 'service_item_id');
    }

    public function requests(): HasMany
    {
        return $this->hasMany(CustomerRequest::class, 'service_item_id');
    }

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(
            Tenant::class,
            'svc_tenant_service_items',
            'service_item_id',
            'tenant_id'
        )->withPivot(['is_active', 'base_price', 'currency', 'lead_time_hours'])->withTimestamps();
    }

    public function tenantServiceItems(): HasMany
    {
        return $this->hasMany(TenantServiceItem::class, 'service_item_id');
    }
}
