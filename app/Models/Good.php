<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Good extends Model
{
    protected $fillable = [
        'id_bmn', 'name', 'nup', 'brand', 'ownership', 'group_id', 'room_id', 'color', 'condition', 'date',
        'documentation', 'note', 'acquisition_price', 'current_price',
    ];

    protected $casts = [
        'documentation' => 'array',
        'date' => 'date',
        'acquisition_price' => 'decimal:2',
        'current_price' => 'decimal:2',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }

    public function borrows()
    {
        return $this->belongsToMany(Borrow::class)
                    ->withPivot('borrow_condition', 'return_condition')
                    ->withTimestamps();
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function getFullNameAttribute(): string
    {
        $brand = $this->brand ? " ({$this->brand})" : '';
        $color = $this->color ? " - {$this->color}" : '';
        return "{$this->id_bmn} — {$this->name}{$brand}{$color}";
    }

    public function getOwnershipLabelAttribute(): ?string
    {
        $options = [
            'a' => 'digunakan seluruhnya untuk penyelenggaraan tupoksi',
            'b' => 'digunakan untuk dioperasikan',
            'c' => 'digunakan oleh unit kerja lain dalam Kementerian/Lembaga yang sama',
            'd' => 'digunakan oleh unit kerja lain dalam Kementerian/Lembaga yang berbeda',
            'e' => 'digunakan oleh pihak lain tidak sesuai dengan peraturan',
            'f' => 'dimanfaatkan: sewa',
            'g' => 'dimanfaatkan: pinjam pakai',
            'h' => 'dimanfaatkan: Kerjasama Pemanfaatan (KSP)',
            'i' => 'dimanfaatkan: Bangun Guna Serah (BGS)/Bangun Serah Guna (BSG)',
            'j' => 'penggunaan lain sesuai dengan peraturan',
            'k' => 'dimanfaatkan tidak sesuai dengan peraturan',
            'l' => 'tidak digunakan untuk fungsi K/L',
            'm' => 'disengketakan di pengadilan atau belum di pengadilan',
        ];

        return $this->ownership ? ($options[$this->ownership] ?? $this->ownership) : null;
    }
}
