<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrow extends Model
{
    protected $fillable = [
        'officer', 'borrower_type', 'borrower',
        'borrower_phone', 'borrower_address', 'borrower_email',
        'borrow_date', 'return_date',
        'borrow_documentation', 'return_documentation',
        'need', 'note', 'application_letter', 'status',
    ];

    protected $casts = [
        'borrow_documentation' => 'array',
        'return_documentation' => 'array',
        'borrow_date' => 'date',
        'return_date' => 'date',
    ];

    public function goods()
    {
        return $this->belongsToMany(Good::class)
                    ->withPivot('borrow_condition', 'return_condition')
                    ->withTimestamps();
    }

    public function borrowGoods()
    {
        return $this->hasMany(BorrowGood::class);
    }
}
