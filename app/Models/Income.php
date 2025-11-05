<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'item_id',
        'amount',
        'income_date',
        'reference_no',
        'description',
        'status'
    ];

    protected $casts = [
        'income_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
