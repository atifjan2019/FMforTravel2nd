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
        'notes',
        'paid_amount',
        'remaining_amount',
        'payment_status'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'payment_status' => 'string'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function paymentHistory()
    {
        return $this->hasMany(PurchasePaymentHistory::class)->orderBy('payment_date', 'desc');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($purchase) {
            $purchase->total_amount = $purchase->quantity * $purchase->unit_price;
        });
    }

    /**
     * Update payment status based on paid amount
     */
    public function updatePaymentStatus()
    {
        if ($this->paid_amount >= $this->total_amount) {
            $this->payment_status = 'paid';
            $this->remaining_amount = 0;
        } elseif ($this->paid_amount > 0) {
            $this->payment_status = 'partial';
            $this->remaining_amount = $this->total_amount - $this->paid_amount;
        } else {
            $this->payment_status = 'unpaid';
            $this->remaining_amount = $this->total_amount;
        }
        $this->save();
    }

    /**
     * Add a payment to this purchase
     */
    public function addPayment($amount)
    {
        if ($amount <= 0) {
            throw new \Exception('Payment amount must be greater than zero');
        }

        if ($this->paid_amount + $amount > $this->total_amount) {
            throw new \Exception('Payment amount exceeds remaining balance');
        }

        $this->paid_amount += $amount;
        $this->updatePaymentStatus();
    }
}
