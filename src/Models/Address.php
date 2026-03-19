<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'svc_addresses';

    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'type',
        'line_1',
        'line_2',
        'city',
        'state',
        'zip',
        'country',
        'lat',
        'lng',
        'is_primary',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'is_primary' => 'boolean',
    ];

    /**
     * Get the parent addressable model (tenant, member, etc.).
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
