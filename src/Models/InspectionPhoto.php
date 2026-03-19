<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InspectionPhoto extends Model
{
    use HasFactory;

    protected $table = 'svc_inspection_photos';

    protected $fillable = [
        'inspection_id',
        'disk',
        'file_path',
        'description',
        'sort_order',
        'uploaded_by_member_id',
    ];

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class, 'inspection_id');
    }

    public function uploadedByMember(): BelongsTo
    {
        return $this->belongsTo(TenantMember::class, 'uploaded_by_member_id');
    }
}
