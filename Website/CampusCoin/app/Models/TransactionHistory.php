<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class TransactionHistory extends Model
{
    // Actual DB table is "transaction_history" (singular) —
    // Laravel's default guess would be "transaction_histories".
    protected $table = 'transaction_history';

    // This table only has created_at, no updated_at.
    public $timestamps = false;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'category_id',
        'description',
        'type',
        'amount',
        'transaction_date',
        'action',
        'old_values',
        'new_values',
        'created_at',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}