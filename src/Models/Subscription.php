<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'svc_subscriptions';

    protected $fillable = [
        'request_id',
        'service_address_id',
        'frequency_unit',
        'frequency_interval',
        'start_date',
        'preferred_time_start',
        'preferred_time_end',
        'end_date',
        'subscription_status',
        'recurring_amount',
        'auto_generate_appointments',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'recurring_amount' => 'decimal:2',
        'auto_generate_appointments' => 'boolean',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(CustomerRequest::class, 'request_id');
    }

    public function serviceAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'service_address_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'subscription_id');
    }
}
