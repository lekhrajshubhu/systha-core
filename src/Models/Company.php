<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Systha\Core\Models\Address;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'svc_companies';

    protected $fillable = [
        'name',
        'dba_name',
        'code',
        'ein',
        'entity_type',
        'registration_state',
        'incorporation_date',
        'tax_classification',
        'email',
        'phone',
        'website',
        'industry',
        'naics_code',
        'license_number',
        'status',
        'notes',
        'meta',
    ];

    protected $casts = [
        'incorporation_date' => 'date',
        'meta' => 'array',
    ];

    /**
     * Get the people linked to this company.
     */
    public function people(): HasMany
    {
        return $this->hasMany(PersonCompany::class, 'company_id');
    }

    /**
     * Get all of the company's addresses.
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
