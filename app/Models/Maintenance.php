<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    protected $fillable = [
        'good_id', 'reason', 'maintenance_date', 'finish_date',
        'location', 'documentation', 'note',
    ];

    protected $casts = [
        'documentation' => 'array',
        'maintenance_date' => 'date',
        'finish_date' => 'date',
    ];

    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }
}
