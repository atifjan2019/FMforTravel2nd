<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'amount',
        'expense_date',
        'reference_no',
        'description',
        'status'
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2'
    ];
}
