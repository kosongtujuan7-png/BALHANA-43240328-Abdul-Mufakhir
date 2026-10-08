<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MarketInterest extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'observed_at',
        'source',
        'account_name',
        'size',
        'color',
        'material',
        'interested_count',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'observed_at' => 'date',
            'interested_count' => 'integer',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}