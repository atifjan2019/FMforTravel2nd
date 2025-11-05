<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'unit',
        'description',
        'status'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }
}
