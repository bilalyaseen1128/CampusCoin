<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'month',
        'limit_amount',
        'amount_spent',
    ];

    protected $casts = [
        'month' => 'date',
        'limit_amount' => 'decimal:2',
        'amount_spent' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}