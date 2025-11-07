<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasePaymentHistory extends Model
{
    use HasFactory;

    protected $table = 'purchase_payment_history';

    protected $fillable = [
        'purchase_id',
        'amount',
        'payment_method',
        'person_reference',
        'payment_date',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
