<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'svc_categories';

    protected $fillable = [
        'name',
        'slug',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function serviceGroups(): HasMany
    {
        return $this->hasMany(ServiceGroup::class, 'category_id');
    }
}
