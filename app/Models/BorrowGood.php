<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BorrowGood extends Pivot
{
    protected $table = 'borrow_good';

    protected $fillable = [
        'borrow_id',
        'good_id',
        'borrow_condition',
        'return_condition',
    ];

    public function borrow()
    {
        return $this->belongsTo(Borrow::class);
    }

    public function good()
    {
        return $this->belongsTo(Good::class);
    }
}
