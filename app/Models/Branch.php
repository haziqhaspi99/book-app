<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    // Senior Standard: Protect columns against mass-assignment vulnerability
    protected $fillable = ['name', 'location'];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function queues(): HasMany
    {
        return $this->hasMany(Queue::class);
    }
}
