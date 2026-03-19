<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceItemQuestion extends Model
{
    use HasFactory;

    protected $table = 'svc_service_item_questions';

    protected $fillable = [
        'service_item_id',
        'question_id',
        'sort_order',
        'is_start',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_start' => 'boolean',
    ];

    public function serviceItem(): BelongsTo
    {
        return $this->belongsTo(ServiceItem::class, 'service_item_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
