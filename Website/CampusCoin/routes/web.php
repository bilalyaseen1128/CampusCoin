<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportInsightsController;
use App\Http\Controllers\SavingTipsController;
use App\Http\Controllers\Admin\AdminAuthController;


// =========================
// PUBLIC PAGES
// =========================

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/report-insights', [ReportInsightsController::class, 'index'])
    ->name('reports.insights');

Route::get('/saving-tips', [SavingTipsController::class, 'index'])
    ->name('saving.tips');

Route::get('/about', function () {
    return view('about');
})->name('about');


// =========================
// USER AUTH ROUTES (default 'web' guard)
// =========================

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'show'])
        ->name('login');

    Route::get('/register', [AuthController::class, 'show'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/forgot-password', [PasswordResetController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetController::class, 'store'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [PasswordResetController::class, 'edit'])
        ->name('password.reset');

    Route::post('/reset-password', [PasswordResetController::class, 'update'])
        ->name('password.update');
});


// =========================
// ADMIN AUTH ROUTES (separate 'admin' guard)
// =========================

Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('admin.login');

    Route::post('/admin/login', [AdminAuthController::class, 'login'])
        ->middleware('throttle:10,1')
        ->name('admin.login.submit');
});

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->middleware('auth:admin')
    ->name('admin.logout');


// =========================
// LOGGED-IN USER ROUTES ('web' guard)
// =========================

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // -------- PROFILE --------
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // -------- DASHBOARD --------
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // -------- CATEGORIES --------
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit');

    // Direct hit on /categories/{id} redirects to the edit page.
    Route::get('/categories/{id}', function ($id) {
        return redirect()->route('categories.edit', $id);
    })->name('categories.show');

    Route::put('/categories/{id}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');

    // -------- INCOME / EXPENSE --------
    Route::get('/income-expense', [TransactionController::class, 'index'])
        ->name('income.expense');

    Route::post('/income-expense', [TransactionController::class, 'store'])
        ->name('transactions.store');

    Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])
        ->name('transactions.edit');

    Route::put('/transactions/{id}', [TransactionController::class, 'update'])
        ->name('transactions.update');

    Route::delete('/income-expense/{id}', [TransactionController::class, 'destroy'])
        ->name('transactions.destroy');

    // -------- BUDGET GOALS --------
    Route::get('/budgets-goal', [BudgetController::class, 'index'])
        ->name('budgets.goal');

    Route::post('/budgets', [BudgetController::class, 'store'])
        ->name('budgets.store');

    Route::put('/budgets/{budget}', [BudgetController::class, 'update'])
        ->name('budgets.update');

    Route::patch('/budgets/{budget}/spending', [BudgetController::class, 'addSpending'])
        ->name('budgets.spending');

    Route::delete('/budgets/{budget}', [BudgetController::class, 'destroy'])
        ->name('budgets.destroy');

    // -------- BOOKMARK API --------
    Route::get('/api/bookmarks', [BookmarkController::class, 'index'])
        ->name('api.bookmarks.index');

    Route::post('/api/bookmarks', [BookmarkController::class, 'store'])
        ->name('api.bookmarks.store');

    Route::delete('/api/bookmarks/{bookmark}', [BookmarkController::class, 'destroy'])
        ->name('api.bookmarks.destroy');

    // -------- NOTES API --------
    Route::get('/api/notes', [NoteController::class, 'index'])
        ->name('api.notes.index');

    Route::post('/api/notes', [NoteController::class, 'store'])
        ->name('api.notes.store');

    Route::delete('/api/notes/{note}', [NoteController::class, 'destroy'])
        ->name('api.notes.destroy');

    // -------- REPORTS API --------
    Route::get('/api/reports', [ReportController::class, 'index'])
        ->name('api.reports.index');
});


// =========================
// ADMIN PANEL (admin guard only)
// =========================

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'index'])
        ->name('index');

    // ---- CATEGORIES ----
    Route::post('/categories', [AdminController::class, 'storeCategory'])
        ->name('categories.store');

    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])
        ->name('categories.update');

    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])
        ->name('categories.destroy');

    // ---- CONTENT ----
    Route::post('/content', [AdminController::class, 'storeContent'])
        ->name('content.store');

    Route::put('/content/{content}', [AdminController::class, 'updateContent'])
        ->name('content.update');

    Route::patch('/content/{content}/publish', [AdminController::class, 'togglePublish'])
        ->name('content.publish');

    Route::delete('/content/{content}', [AdminController::class, 'destroyContent'])
        ->name('content.destroy');

    // ---- USER MANAGEMENT ----
    Route::get('/users', [AdminController::class, 'usersIndex'])
        ->name('users.index');

    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])
        ->name('users.edit');

    Route::put('/users/{user}', [AdminController::class, 'updateUser'])
        ->name('users.update');

    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])
        ->name('users.destroy');

});


// =========================
// BOOKMARK PAGE
// =========================

Route::get('/bookMarking', function () {
    return view('bookMarking');
})->name('bookMarking');

Route::get('/bookmarks', function () {
    return view('bookMarking');
})->name('bookmarks.index');