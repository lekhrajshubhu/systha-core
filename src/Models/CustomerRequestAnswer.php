<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerRequestAnswer extends Model
{
    use HasFactory;

    protected $table = 'svc_customer_request_answers';

    protected $fillable = [
        'request_id',
        'question_id',
        'question_code',
        'question_text',
        'answer',
        'price_type',
        'price',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(CustomerRequest::class, 'request_id');
    }
}
