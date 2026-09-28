<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();

        $categories = Category::all()->map(function ($category) {
            $usage = 0;

            if (Schema::hasTable('transactions') && Schema::hasColumn('transactions', 'category_id')) {
                $usage += DB::table('transactions')->where('category_id', $category->id)->count();
            }
            if (Schema::hasTable('recurring_transactions') && Schema::hasColumn('recurring_transactions', 'category_id')) {
                $usage += DB::table('recurring_transactions')->where('category_id', $category->id)->count();
            }

            $category->usage = $usage;

            return $category;
        });

        $contents = class_exists(\App\Models\Content::class) ? \App\Models\Content::latest()->get() : collect();

        $users = User::latest()->get()->map(function ($user) {
            $txCount = 0;

            if (Schema::hasTable('transactions') && Schema::hasColumn('transactions', 'user_id')) {
                $txCount += DB::table('transactions')->where('user_id', $user->id)->count();
            }
            if (Schema::hasTable('recurring_transactions') && Schema::hasColumn('recurring_transactions', 'user_id')) {
                $txCount += DB::table('recurring_transactions')->where('user_id', $user->id)->count();
            }

            $user->transactions = $txCount;
            $user->joined       = $user->created_at?->format('M d, Y');
            $user->status       = $user->is_active ? 'active' : 'disabled';

            return $user;
        });

        $activities = [];

        $totalTransactions = 0;
        $incomeCount       = 0;

        if (Schema::hasTable('transactions')) {
            $totalTransactions += DB::table('transactions')->count();

            if (Schema::hasColumn('transactions', 'category_id')) {
                $incomeCount += DB::table('transactions')
                    ->join('categories', 'transactions.category_id', '=', 'categories.id')
                    ->where('categories.type', 'income')
                    ->count();
            }
        }

        if (Schema::hasTable('recurring_transactions')) {
            $totalTransactions += DB::table('recurring_transactions')->count();

            if (Schema::hasColumn('recurring_transactions', 'category_id')) {
                $incomeCount += DB::table('recurring_transactions')
                    ->join('categories', 'recurring_transactions.category_id', '=', 'categories.id')
                    ->where('categories.type', 'income')
                    ->count();
            }
        }

        $stats = [
            'activeUsers'       => $users->where('status', 'active')->count(),
            'totalTransactions' => $totalTransactions,
            'categoryCount'     => $categories->count(),
            'incomeCount'       => $incomeCount,
        ];

        // ---- TRANSACTIONS (read-only list for the admin panel) ----
        $transactions = collect();

        if (Schema::hasTable('transactions')) {
            $query = DB::table('transactions')
                ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
                ->leftJoin('categories', 'transactions.category_id', '=', 'categories.id')
                ->select(
                    'transactions.id',
                    'transactions.description',
                    'transactions.type',
                    'transactions.amount',
                    'transactions.transaction_date',
                    'transactions.is_flagged',
                    'users.name as user_name',
                    'users.email as user_email',
                    'categories.name as category_name'
                );

            // Hide soft-deleted transactions.
            if (Schema::hasColumn('transactions', 'deleted_at')) {
                $query->whereNull('transactions.deleted_at');
            }

            $transactions = $query
                ->orderByDesc('transactions.transaction_date')
                ->orderByDesc('transactions.id')
                ->limit(500)
                ->get()
                ->map(function ($t) {
                    return [
                        'id'          => $t->id,
                        'user'        => $t->user_name ?? 'Deleted user',
                        'email'       => $t->user_email ?? '-',
                        'category'    => $t->category_name ?? 'Uncategorized',
                        'description' => $t->description ?: '-',
                        'type'        => $t->type,
                        'amount'      => (float) $t->amount,
                        'date'        => Carbon::parse($t->transaction_date)->format('M d, Y'),
                        'flagged'     => (bool) $t->is_flagged,
                    ];
                });
        }

        return view('admin', compact('admin', 'categories', 'contents', 'users', 'activities', 'stats', 'transactions'));
    }

    // ---- CATEGORIES ----
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'string'],
        ]);

        $validated['is_default'] = true;

        $category = Category::create($validated);
        $category->usage = 0;

        return response()->json(['category' => $category]);
    }

    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'string'],
        ]);

        $category->update($validated);

        return response()->json(['category' => $category]);
    }

    public function destroyCategory(Category $category)
    {
        // Find or create a fallback "Uncategorized" category of the same type,
        // so existing transactions keep a valid category instead of blocking the delete.
        $fallback = Category::firstOrCreate(
            ['name' => 'Uncategorized', 'type' => $category->type],
            ['is_default' => true]
        );

        if ($fallback->id !== $category->id) {
            if (Schema::hasTable('transactions') && Schema::hasColumn('transactions', 'category_id')) {
                DB::table('transactions')
                    ->where('category_id', $category->id)
                    ->update(['category_id' => $fallback->id]);
            }

            if (Schema::hasTable('recurring_transactions') && Schema::hasColumn('recurring_transactions', 'category_id')) {
                DB::table('recurring_transactions')
                    ->where('category_id', $category->id)
                    ->update(['category_id' => $fallback->id]);
            }
        }

        try {
            $category->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['message' => 'This category could not be deleted.'], 422);
        }

        return response()->json(['message' => 'Category deleted successfully. Its existing transactions were moved to "Uncategorized".']);
    }

    // ---- CONTENT (Tips & Announcements) ----
    public function storeContent(Request $request)
    {
        $validated = $request->validate([
            'type'  => ['required', 'string', Rule::in(['Saving Tip', 'Announcement'])],
            'title' => ['required', 'string', 'max:255'],
            'text'  => ['required', 'string'],
        ]);

        $validated['status'] = 'Draft';

        $content = Content::create($validated);

        return response()->json(['content' => $content], 201);
    }

    public function updateContent(Request $request, Content $content)
    {
        $validated = $request->validate([
            'type'  => ['required', 'string', Rule::in(['Saving Tip', 'Announcement'])],
            'title' => ['required', 'string', 'max:255'],
            'text'  => ['required', 'string'],
        ]);

        $content->update($validated);

        return response()->json(['content' => $content]);
    }

    public function togglePublish(Content $content)
    {
        $content->update([
            'status' => $content->status === 'Published' ? 'Draft' : 'Published',
        ]);

        return response()->json(['status' => $content->status]);
    }

    public function destroyContent(Content $content)
    {
        $content->delete();

        return response()->json(['message' => 'Content deleted successfully.']);
    }

    // ---- USER MANAGEMENT ----
    public function usersIndex()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'is_active' => ['boolean'],
        ]);

        $user->update($validated);

        return response()->json(['message' => 'User updated successfully.']);
    }

    public function destroyUser(User $user)
    {
        try {
            $user->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'This user has existing transactions and cannot be deleted. Consider disabling the account instead.',
            ], 422);
        }

        return response()->json(['message' => 'User deleted successfully.']);
    }
}