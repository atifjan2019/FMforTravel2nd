<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
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
        'total_income',
        'total_paid',
        'balance'
    ];

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function payments()
    {
        return $this->hasMany(CustomerPayment::class);
    }

    public function getTotalIncomeAttribute()
    {
        return $this->incomes()->sum('amount');
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->sum('amount');
    }

    public function getBalanceAttribute()
    {
        return $this->total_income - $this->total_paid;
    }
}
