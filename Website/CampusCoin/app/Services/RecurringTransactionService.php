<?php

namespace App\Services;

use App\Models\RecurringTransaction;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Turns recurring rules into real transactions.
 *
 * No cron job is needed: generateDue() is called whenever the student opens
 * the Income & Expenses page or the Dashboard, and it creates every
 * transaction whose date has arrived.
 */
class RecurringTransactionService
{
    /** Max transactions created per rule per call (safety net). */
    private const MAX_CATCH_UP = 60;

    /**
     * Create all transactions that are due for one user.
     *
     * @return int number of transactions created
     */
    public function generateDue(int $userId): int
    {
        $today   = Carbon::today();
        $created = 0;

        $ruleIds = RecurringTransaction::where('user_id', $userId)
            ->where('is_active', 1)
            ->whereDate('next_run_date', '<=', $today->toDateString())
            ->pluck('id');

        foreach ($ruleIds as $id) {
            DB::transaction(function () use ($id, $today, &$created) {
                // Lock the rule so two requests at the same time cannot
                // create the same transaction twice (needs InnoDB).
                $rule = RecurringTransaction::lockForUpdate()->find($id);

                if (! $rule || ! $rule->is_active) {
                    return;
                }

                $guard = 0;

                while ($rule->next_run_date->lte($today) && $guard++ < self::MAX_CATCH_UP) {
                    if ($rule->end_date && $rule->next_run_date->gt($rule->end_date)) {
                        break;
                    }

                    $date = $rule->next_run_date->toDateString();

                    $alreadyThere = Transaction::withTrashed()
                        ->where('recurring_id', $rule->id)
                        ->whereDate('transaction_date', $date)
                        ->exists();

                    if (! $alreadyThere) {
                        $tx = Transaction::create([
                            'user_id'          => $rule->user_id,
                            'category_id'      => $rule->category_id,
                            'recurring_id'     => $rule->id,
                            'description'      => $rule->description,
                            'type'             => $rule->type,
                            'amount'           => $rule->amount,
                            'transaction_date' => $date,
                        ]);

                        TransactionHistory::create([
                            'transaction_id'   => $tx->id,
                            'user_id'          => $rule->user_id,
                            'description'      => $tx->description,
                            'category_id'      => $tx->category_id,
                            'type'             => $tx->type,
                            'amount'           => $tx->amount,
                            'transaction_date' => $tx->transaction_date,
                            'action'           => 'created',
                            'old_values'       => null,
                            'new_values'       => $tx->toArray(),
                            'created_at'       => now(),
                        ]);

                        $created++;
                    }

                    $rule->next_run_date = $this->nextDate(
                        $rule->start_date,
                        $rule->next_run_date,
                        $rule->frequency
                    );
                }

                if ($rule->hasEnded()) {
                    $rule->is_active = false;
                }

                $rule->save();
            });
        }

        return $created;
    }

    /**
     * Next occurrence after $current.
     * Monthly / yearly rules keep the original day of the month
     * (31 Jan -> 28 Feb -> 31 Mar, not 31 Jan -> 28 Feb -> 28 Mar).
     */
    public function nextDate($start, $current, string $frequency): Carbon
    {
        $start   = Carbon::parse($start)->startOfDay();
        $current = Carbon::parse($current)->startOfDay();

        if ($frequency === 'weekly') {
            return $current->copy()->addWeek();
        }

        $next = $frequency === 'yearly'
            ? $current->copy()->addYearNoOverflow()
            : $current->copy()->addMonthNoOverflow();

        $next->day(min($start->day, $next->daysInMonth));

        return $next;
    }

    /** First occurrence that is today or later (used when a rule is resumed). */
    public function firstOnOrAfter($start, $from, string $frequency, Carbon $today): Carbon
    {
        $date  = Carbon::parse($from)->startOfDay();
        $guard = 0;

        while ($date->lt($today) && $guard++ < 500) {
            $date = $this->nextDate($start, $date, $frequency);
        }

        return $date;
    }
}