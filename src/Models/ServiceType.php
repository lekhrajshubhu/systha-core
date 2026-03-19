<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceType extends Model
{
    use HasFactory;

    protected $table = 'svc_service_types';

    protected $fillable = [
        'service_group_id',
        'name',
        'slug',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function serviceGroup(): BelongsTo
    {
        return $this->belongsTo(ServiceGroup::class, 'service_group_id');
    }

    public function serviceItems(): HasMany
    {
        return $this->hasMany(ServiceItem::class, 'service_type_id');
    }
}
