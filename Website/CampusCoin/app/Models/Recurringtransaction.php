<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecurringTransaction extends Model
{
    protected $table = 'recurring_transactions';

    protected $fillable = [
        'user_id',
        'category_id',
        'type',
        'amount',
        'description',
        'frequency',
        'start_date',
        'end_date',
        'next_run_date',
        'is_active',
    ];

    protected $casts = [
        'start_date'    => 'date',
        'end_date'      => 'date',
        'next_run_date' => 'date',
        'amount'        => 'decimal:2',
        'is_active'     => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /** True when the rule ran past its end date (cannot be resumed). */
    public function hasEnded(): bool
    {
        return $this->end_date !== null && $this->next_run_date->gt($this->end_date);
    }
}