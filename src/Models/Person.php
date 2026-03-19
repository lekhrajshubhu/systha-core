<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'svc_persons';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'mobile',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * Get the tenant accounts for the person.
     */
    public function accounts(): HasMany
    {
        return $this->hasMany(TenantCustomer::class, 'person_id');
    }

    /**
     * Get the tenants the person has accounts with.
     */
    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class, 'svc_tenant_customers', 'person_id', 'tenant_id');
    }

    /**
     * Get the tenant member profiles for this person.
     */
    public function tenantMembers(): HasMany
    {
        return $this->hasMany(TenantMember::class, 'person_id');
    }

    /**
     * Get the tenant customer accounts for this person.
     */
    public function tenantCustomers(): HasMany
    {
        return $this->hasMany(TenantCustomer::class, 'person_id');
    }

    /**
     * Get the company links for this person.
     */
    public function companies(): HasMany
    {
        return $this->hasMany(PersonCompany::class, 'person_id');
    }
}
