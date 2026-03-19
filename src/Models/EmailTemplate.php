<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Systha\Core\Models\Tenant;

class EmailTemplate extends Model
{
    protected $table = 'svc_email_templates';

    protected $fillable = [
        'tenant_id',
        'code',
        'name',
        'subject',
        'required_fields',
        'body',
        'meta',
        'is_active',
        'is_deleted',
    ];

    protected $casts = [
        'meta' => 'array',
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
