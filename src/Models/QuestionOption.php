<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionOption extends Model
{
    use HasFactory;

    protected $table = 'svc_question_options';

    protected $fillable = [
        'question_id',
        'label',
        'value',
        'price_adjustment',
        'next_question_id',
        'sort_order',
    ];

    protected $casts = [
        'price_adjustment' => 'decimal:2',
        'sort_order' => 'integer',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function nextQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'next_question_id');
    }

}
