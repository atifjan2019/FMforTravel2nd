<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'status'
    ];

    protected $appends = [
        'total_purchases',
        'total_paid',
        'balance'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function payments()
    {
        return $this->hasMany(SupplierPayment::class);
    }

    public function getTotalPurchasesAttribute()
    {
        return $this->purchases()->sum('total_amount');
    }

    public function getTotalPaidAttribute()
    {
        // Sum paid_amount from all related purchases (partial/full payments)
        return $this->purchases()->sum('paid_amount');
    }

    public function getBalanceAttribute()
    {
        return $this->total_purchases - $this->total_paid;
    }
}
