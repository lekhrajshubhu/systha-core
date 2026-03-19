<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FreeEstimation extends Model
{
    use HasFactory;

    protected $table = 'svc_free_estimations';

    protected $fillable = [
        'request_id',
        'status',
        'quoted_at',
        'closed_at',
        'notes',
    ];

    protected $casts = [
        'quoted_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(CustomerRequest::class, 'request_id');
    }
}
