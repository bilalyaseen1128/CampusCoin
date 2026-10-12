<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RecurringTransaction;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use App\Services\RecurringTransactionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    public function __construct(private RecurringTransactionService $recurring)
    {
    }

    // Categories jo is user ko allowed hain (apni + default)
    private function userCategories()
    {
        return Category::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhere('is_default', 1);
        })
            ->orderBy('name')
            ->get();
    }

    // Add / update dono ke liye same validation
    private function rules(Request $request, bool $withRepeat = false): array
    {
        $rules = [
            'description' => 'required|string|max:255',
            'category_id' => [
                'required',
                // user ki apni ya default category, AUR type transaction type se match kare
                Rule::exists('categories', 'id')->where(function ($q) use ($request) {
                    $q->where('type', $request->input('type'))
                        ->where(function ($q) {
                            $q->where('user_id', Auth::id())
                                ->orWhere('is_default', 1);
                        });
                }),
            ],
            'type' => 'required|in:income,expense',
            // decimal(10,2): 0.01 se 99,999,999.99
            'amount' => 'required|numeric|min:0.01|max:99999999.99',
            'transaction_date' => 'required|date',
        ];

        if ($withRepeat) {
            $rules['repeat']   = 'nullable|in:none,weekly,monthly,yearly';
            $rules['end_date'] = 'nullable|date|after_or_equal:transaction_date';
        }

        return $rules;
    }

    private function messages(): array
    {
        return [
            'category_id.exists' => 'Please pick a category that matches the transaction type (income or expense).',
            'end_date.after_or_equal' => 'The stop date must be on or after the transaction date.',
        ];
    }

    private function logHistory(Transaction $transaction, string $action, ?array $old, ?array $new): void
    {
        TransactionHistory::create([
            'transaction_id' => $transaction->id,
            'user_id' => Auth::id(),
            'description' => $transaction->description,
            'category_id' => $transaction->category_id,
            'type' => $transaction->type,
            'amount' => $transaction->amount,
            'transaction_date' => $transaction->transaction_date,
            'action' => $action,
            'old_values' => $old,
            'new_values' => $new,
            'created_at' => now(),
        ]);
    }


    // Show transactions
    public function index(Request $request)
    {
        // Recurring rules jinka waqt aa gaya hai, unki transactions ab bana do
        $autoCreated = $this->recurring->generateDue(Auth::id());

        if ($autoCreated > 0) {
            session()->now('success', $autoCreated . ' recurring transaction(s) were added automatically.');
        }

        // ---------- Table query (saare filters) ----------
        $query = Transaction::where('user_id', Auth::id())
            ->with('category');

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->date_from) {
            $query->whereDate('transaction_date', '>=', $request->date_from);
        }

        if ($request->date_to) {
            $query->whereDate('transaction_date', '<=', $request->date_to);
        }

        // get() ki jagah paginate(), view mein pages ke links aate hain
        $transactions = $query
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        // ---------- Cards query ----------
        $cardQuery = Transaction::where('user_id', Auth::id());

        if ($request->date_from || $request->date_to) {
            // Date filter lagao to cards bhi usi period ke hon
            if ($request->date_from) {
                $cardQuery->whereDate('transaction_date', '>=', $request->date_from);
            }
            if ($request->date_to) {
                $cardQuery->whereDate('transaction_date', '<=', $request->date_to);
            }
            $periodLabel = 'Selected period';
        } else {
            // Default: saare transactions (future dates bhi).
            // Sirf is mahine ka chahiye to ye 2 lines kholo aur 'All time' wali hata do:
            // $cardQuery->whereMonth('transaction_date', now()->month)
            //           ->whereYear('transaction_date', now()->year);
            // $periodLabel = now()->format('F Y');
            $periodLabel = 'All time';
        }

        // Database mein hi sum, saari rows memory mein nahi layi jati
        $income = (clone $cardQuery)->where('type', 'income')->sum('amount');
        $expense = (clone $cardQuery)->where('type', 'expense')->sum('amount');

        $balance = $income - $expense;

        $expenseRatio = $income > 0
            ? ($expense / $income) * 100
            : 0;

        $categories = $this->userCategories();

        // ---------- Recurring rules (manage list) ----------
        $recurringRules = RecurringTransaction::with('category')
            ->where('user_id', Auth::id())
            ->orderByDesc('is_active')
            ->orderBy('next_run_date')
            ->get();

        return view('income-expense', compact(
            'transactions',
            'categories',
            'income',
            'expense',
            'balance',
            'expenseRatio',
            'periodLabel',
            'recurringRules'
        ));
    }


    // Add new transaction (optionally with a repeat rule)
    public function store(Request $request)
    {
        $data = $request->validate($this->rules($request, true), $this->messages());

        $repeat = $data['repeat'] ?? 'none';

        DB::transaction(function () use ($data, $repeat) {
            $rule = null;

            if ($repeat !== 'none') {
                $start = Carbon::parse($data['transaction_date'])->startOfDay();
                $next  = $this->recurring->nextDate($start, $start, $repeat);
                $end   = $data['end_date'] ?? null;

                $rule = RecurringTransaction::create([
                    'user_id'       => Auth::id(),
                    'category_id'   => $data['category_id'],
                    'type'          => $data['type'],
                    'amount'        => $data['amount'],
                    'description'   => $data['description'],
                    'frequency'     => $repeat,
                    'start_date'    => $start->toDateString(),
                    'end_date'      => $end,
                    'next_run_date' => $next->toDateString(),
                    'is_active'     => $end === null || $next->lte(Carbon::parse($end)),
                ]);
            }

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'category_id' => $data['category_id'],
                'recurring_id' => $rule?->id,
                'description' => $data['description'],
                'type' => $data['type'],
                'amount' => $data['amount'],
                'transaction_date' => $data['transaction_date'],
            ]);

            $this->logHistory($transaction, 'created', null, $transaction->toArray());
        });

        return redirect()
            ->route('income.expense')
            ->with('success', $repeat === 'none'
                ? 'Transaction added successfully.'
                : 'Transaction added. It will repeat ' . $repeat . ' automatically.');
    }


    // Show edit form (purana alag page, ab modal use hota hai magar route chalta rahe)
    public function edit($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())
            ->findOrFail($id);

        $categories = $this->userCategories();

        return view('transaction-edit', compact('transaction', 'categories'));
    }


    // Update transaction (sirf ye ek entry, repeat rule nahi badalta)
    public function update(Request $request, $id)
    {
        $request->validate($this->rules($request), $this->messages());

        $transaction = Transaction::where('user_id', Auth::id())
            ->findOrFail($id);

        DB::transaction(function () use ($request, $transaction) {
            $oldValues = $transaction->toArray();

            $transaction->update([
                'category_id' => $request->category_id,
                'description' => $request->description,
                'type' => $request->type,
                'amount' => $request->amount,
                'transaction_date' => $request->transaction_date,
            ]);

            $this->logHistory($transaction, 'updated', $oldValues, $transaction->toArray());
        });

        return redirect()
            ->route('income.expense')
            ->with('success', 'Transaction updated successfully.');
    }


    // Delete transaction (soft delete: row aur history dono bachti hain)
    public function destroy($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())
            ->findOrFail($id);

        DB::transaction(function () use ($transaction) {
            $this->logHistory($transaction, 'deleted', $transaction->toArray(), null);

            $transaction->delete(); // SoftDeletes: sets deleted_at
        });

        return redirect()
            ->route('income.expense')
            ->with('success', 'Transaction deleted successfully.');
    }


    // ================= RECURRING RULES =================

    // Pause / resume a rule
    public function toggleRecurring($id)
    {
        $rule = RecurringTransaction::where('user_id', Auth::id())->findOrFail($id);

        if ($rule->is_active) {
            $rule->update(['is_active' => false]);

            return back()->with('success', 'Recurring transaction paused.');
        }

        if ($rule->hasEnded()) {
            return back()->withErrors(['recurring' => 'This recurring transaction has already ended.']);
        }

        // Resume from the next date that is today or later, so the
        // paused period is not filled with back-dated transactions.
        $next = $this->recurring->firstOnOrAfter(
            $rule->start_date,
            $rule->next_run_date,
            $rule->frequency,
            Carbon::today()
        );

        $rule->update([
            'next_run_date' => $next->toDateString(),
            'is_active'     => $rule->end_date === null || $next->lte($rule->end_date),
        ]);

        return back()->with('success', 'Recurring transaction resumed.');
    }

    // Delete a rule. Transactions it already created are kept.
    public function destroyRecurring($id)
    {
        $rule = RecurringTransaction::where('user_id', Auth::id())->findOrFail($id);

        DB::transaction(function () use ($rule) {
            Transaction::withTrashed()
                ->where('recurring_id', $rule->id)
                ->update(['recurring_id' => null]);

            $rule->delete();
        });

        return back()->with('success', 'Recurring transaction deleted. Past entries were kept.');
    }
}