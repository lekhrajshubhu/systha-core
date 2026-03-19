<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionTransition extends Model
{
    use HasFactory;

    protected $table = 'svc_question_transitions';

    protected $fillable = [
        'service_item_id',
        'from_question_id',
        'question_option_id',
        'to_question_id',
        'action_type',
        'priority',
    ];

    protected $casts = [
        'priority' => 'integer',
    ];

    public function serviceItem(): BelongsTo
    {
        return $this->belongsTo(ServiceItem::class, 'service_item_id');
    }

    public function fromQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'from_question_id');
    }

    public function questionOption(): BelongsTo
    {
        return $this->belongsTo(QuestionOption::class, 'question_option_id');
    }

    public function toQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'to_question_id');
    }
}
