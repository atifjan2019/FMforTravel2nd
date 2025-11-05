<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'item_id',
        'quantity',
        'unit_price',
        'total_amount',
        'purchase_date',
        'reference_no',
        'notes'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($purchase) {
            $purchase->total_amount = $purchase->quantity * $purchase->unit_price;
        });
    }
}
