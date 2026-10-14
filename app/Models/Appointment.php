<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    protected $fillable = ['branch_id', 'customer_name', 'customer_phone', 'appointment_time', 'status'];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function queue(): HasOne
    {
        return $this->hasOne(Queue::class);
    }
}
