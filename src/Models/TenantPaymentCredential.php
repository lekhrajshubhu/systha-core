<?php

namespace Systha\Core\Models;


use Illuminate\Database\Eloquent\Model;
use Systha\Core\Models\Tenant;

class TenantPaymentCredential extends Model
{
    protected $table = 'svc_tenant_payment_credentials';

    protected $fillable = [
        'tenant_id',
        'name',
        'code',
        'credentials',
        'is_default',
    ];

    protected $casts = [
        'credentials' => 'array',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
