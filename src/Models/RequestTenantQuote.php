<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestTenantQuote extends Model
{
    use HasFactory;

    protected $table = 'svc_request_tenant_quotes';

    protected $fillable = [
        'request_id',
        'tenant_id',
        'status',
        'amount',
        'notes',
        'quoted_at',
        'responded_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'quoted_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(CustomerRequest::class, 'request_id');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
