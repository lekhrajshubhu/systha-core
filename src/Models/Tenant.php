<?php

namespace Systha\Core\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'svc_tenants';

    protected $fillable = [
        'name',
        'code',
        'email',
        'phone',
        'mobile',
        'logo',
        'status',
        'timezone',
        'currency',
        'is_active',
        'is_verified',
        'meta',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_verified' => 'boolean',
        'meta' => 'array',
    ];

    /**
     * Get the members for the tenant.
     */
    public function members(): HasMany
    {
        return $this->hasMany(TenantMember::class, 'tenant_id');
    }

    /**
     * Get the customer accounts for the tenant.
     */
    public function customerAccounts(): HasMany
    {
        return $this->hasMany(TenantCustomer::class, 'tenant_id');
    }

    /**
     * Get the customers linked to the tenant.
     */
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'svc_tenant_customers', 'tenant_id', 'person_id');
    }

    /**
     * Get the service items for the tenant.
     */
    public function tenantServiceItems(): HasMany
    {
        return $this->hasMany(TenantServiceItem::class, 'tenant_id');
    }

    /**
     * Get the quotes for the tenant.
     */
    public function requestTenantQuotes(): HasMany
    {
        return $this->hasMany(RequestTenantQuote::class, 'tenant_id');
    }

    /**
     * Get all of the tenant's addresses.
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Get the tenant's office address.
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable')->where('type', 'office');
    }

     /**
     * Get the payments for the tenant.
     */
    public function paymentCredentials(): HasMany
    {
        return $this->hasMany(TenantPaymentCredential::class, 'tenant_id');
    }

    /**
     * Get the default payment credential for the tenant.
     */
    public function defaultPaymentCredential(): HasOne
    {
        return $this->hasOne(TenantPaymentCredential::class, 'tenant_id')->where('is_default', 1);
    }
}
