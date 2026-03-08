<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Room extends Model
{
    protected $fillable = [
        'name', 'status', 'dimension', 'documentation', 'note',
    ];

    protected $casts = [
        'status' => 'boolean',
        'documentation' => 'array',
    ];

    public function goods(): HasMany
    {
        return $this->hasMany(Good::class);
    }
}
