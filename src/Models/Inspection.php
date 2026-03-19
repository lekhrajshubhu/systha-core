<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inspection extends Model
{
    use HasFactory;

    protected $table = 'svc_inspections';

    protected $fillable = [
        'request_id',
        'inspected_by_member_id',
        'inspection_status',
        'inspection_type',
        'summary',
        'findings',
        'recommendation',
        'notes',
        'inspected_at',
    ];

    protected $casts = [
        'inspected_at' => 'datetime',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(CustomerRequest::class, 'request_id');
    }

    public function inspectedByMember(): BelongsTo
    {
        return $this->belongsTo(TenantMember::class, 'inspected_by_member_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(InspectionPhoto::class, 'inspection_id');
    }
}
