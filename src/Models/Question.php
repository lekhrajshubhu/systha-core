<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $table = 'svc_questions';

    protected $fillable = [
        'service_item_id',
        'code',
        'title',
        'field_type',
        'is_required',
        'is_start',
        'previous_question_id',
        'next_question_id',
        'is_active',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_start' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function serviceItem(): BelongsTo
    {
        return $this->belongsTo(ServiceItem::class, 'service_item_id');
    }

    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }

    public function previousQuestion(): BelongsTo
    {
        return $this->belongsTo(self::class, 'previous_question_id');
    }

    public function nextQuestion(): BelongsTo
    {
        return $this->belongsTo(self::class, 'next_question_id');
    }

    public function previousQuestions(): HasMany
    {
        return $this->hasMany(self::class, 'next_question_id');
    }

    public function nextQuestions(): HasMany
    {
        return $this->hasMany(self::class, 'previous_question_id');
    }

    public function serviceGroups(): BelongsToMany
    {
        return $this->belongsToMany(
            ServiceGroup::class,
            'svc_service_group_questions',
            'question_id',
            'service_group_id'
        )->withPivot(['sort_order', 'is_start'])->withTimestamps();
    }

    public function serviceItems(): BelongsToMany
    {
        return $this->belongsToMany(
            ServiceItem::class,
            'svc_service_item_questions',
            'question_id',
            'service_item_id'
        )->withPivot(['sort_order', 'is_start'])->withTimestamps();
    }

    // Snapshot-based request answers are stored without dependency on questions.

}
