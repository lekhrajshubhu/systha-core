<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceGroupQuestion extends Model
{
    use HasFactory;

    protected $table = 'svc_service_group_questions';

    protected $fillable = [
        'service_group_id',
        'question_id',
        'sort_order',
        'is_start',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_start' => 'boolean',
    ];

    public function serviceGroup(): BelongsTo
    {
        return $this->belongsTo(ServiceGroup::class, 'service_group_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
