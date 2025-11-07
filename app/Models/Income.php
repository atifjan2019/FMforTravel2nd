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
        'paid_amount',
        'remaining_amount',
        'income_date',
        'reference_no',
        'description',
        'status',
        'payment_status'
    ];

    protected $casts = [
        'income_date' => 'date',
        'amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function paymentHistory()
    {
        return $this->hasMany(IncomePaymentHistory::class)->orderBy('payment_date', 'desc');
    }

    // Calculate and update payment status
    public function updatePaymentStatus()
    {
        $this->remaining_amount = $this->amount - $this->paid_amount;
        
        if ($this->paid_amount == 0) {
            $this->payment_status = 'unpaid';
        } elseif ($this->paid_amount >= $this->amount) {
            $this->payment_status = 'paid';
            $this->paid_amount = $this->amount; // Cap at total amount
            $this->remaining_amount = 0;
        } else {
            $this->payment_status = 'partial';
        }
        
        $this->save();
    }

    // Add payment
    public function addPayment($amount)
    {
        $this->paid_amount += $amount;
        $this->updatePaymentStatus();
    }
}
