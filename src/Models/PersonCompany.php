<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonCompany extends Model
{
    use HasFactory;

    protected $table = 'svc_person_companies';

    protected $fillable = [
        'person_id',
        'company_id',
        'relation_type',
        'job_title',
        'department',
        'is_primary',
        'is_active',
        'start_date',
        'end_date',
        'notes',
        'meta',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'meta' => 'array',
    ];

    /**
     * Get the person for this link.
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * Get the company for this link.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
