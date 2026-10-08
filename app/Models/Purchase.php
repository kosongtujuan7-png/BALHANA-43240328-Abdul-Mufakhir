<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_code',
        'ordered_at',
        'supplier_name',
        'status',
        'total',
        'estimated_shipping',
        'other_costs',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'ordered_at' => 'date',
            'total' => 'decimal:2',
            'estimated_shipping' => 'decimal:2',
            'other_costs' => 'decimal:2',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }
}