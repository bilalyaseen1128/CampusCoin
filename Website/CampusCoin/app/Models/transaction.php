<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    // Soft delete: the row stays in the table (deleted_at is set), so the
    // full history is retained, as the SRS requires.
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'recurring_id',
        'description',
        'type',
        'amount',
        'transaction_date',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function recurringRule()
    {
        return $this->belongsTo(RecurringTransaction::class, 'recurring_id');
    }
}