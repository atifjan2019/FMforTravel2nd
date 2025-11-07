<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomePaymentHistory extends Model
{
    use HasFactory;

    protected $table = 'income_payment_history';

    protected $fillable = [
        'income_id',
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

    public function income()
    {
        return $this->belongsTo(Income::class);
    }
}
