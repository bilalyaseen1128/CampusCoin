<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the profile page.
     * (Route: GET /profile  ->  name: profile)
     */
    public function show()
    {
        return view('profile');
    }

    /**
     * Update name, email and student details
     * (academic year, monthly allowance baseline, monthly savings goal).
     * (Route: PUT /profile  ->  name: profile.update)
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],

            'academic_year'              => ['nullable', 'string', 'max:50'],
            // decimal(10,2) columns -> max 99,999,999.99
            'monthly_allowance_baseline' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'monthly_savings_goal'       => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
        ]);

        // The two money columns are NOT NULL (default 0): an empty box means 0.
        $validated['monthly_allowance_baseline'] = $validated['monthly_allowance_baseline'] ?? 0;
        $validated['monthly_savings_goal']       = $validated['monthly_savings_goal'] ?? 0;

        $user->fill($validated)->save();

        return back()->with('status', 'Profile updated successfully.');
    }

    /**
     * Change password.
     * (Route: PUT /profile/password  ->  name: profile.password)
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', Password::min(8), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'Password updated successfully.');
    }

    /**
     * Delete the account together with the user's own data.
     * (Route: DELETE /profile  ->  name: profile.destroy)
     *
     * Transactions, budgets and notes have no database-level cascade,
     * so they are removed here; otherwise they would stay behind as
     * orphan rows (and show up in the admin panel as "Deleted user").
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        DB::transaction(function () use ($user) {
            $id = $user->id;

            // transaction_history rows go with their transactions (FK cascade)
            DB::table('transactions')->where('user_id', $id)->delete();
            DB::table('budgets')->where('user_id', $id)->delete();
            DB::table('notes')->where('user_id', $id)->delete();

            if (Schema::hasTable('recurring_transactions')) {
                DB::table('recurring_transactions')->where('user_id', $id)->delete();
            }

            // categories, bookmarks, insights, saving tips, sessions cascade from users
            $user->delete();
        });

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}