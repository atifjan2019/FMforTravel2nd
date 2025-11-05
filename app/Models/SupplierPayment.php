<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'amount',
        'payment_date',
        'payment_method',
        'reference_no',
        'notes'
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
