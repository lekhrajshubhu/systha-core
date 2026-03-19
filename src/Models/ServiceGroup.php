<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceGroup extends Model
{
    use HasFactory;

    protected $table = 'svc_service_groups';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function serviceItems(): HasMany
    {
        return $this->hasMany(ServiceItem::class, 'service_group_id');
    }

    public function serviceTypes(): HasMany
    {
        return $this->hasMany(ServiceType::class, 'service_group_id');
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(
            Question::class,
            'svc_service_group_questions',
            'service_group_id',
            'question_id'
        )->withPivot(['sort_order', 'is_start'])->withTimestamps();
    }

    public function serviceGroupQuestions(): HasMany
    {
        return $this->hasMany(ServiceGroupQuestion::class, 'service_group_id');
    }
}
