<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return view('profile', [
            'user' => $request->user(),
        ]);
    }
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'                       => ['required', 'string', 'max:255'],
            'email'                      => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'academic_year'              => ['nullable', 'string', 'in:School,First Year,Second Year,University,Graduate'],
            'monthly_allowance_baseline' => ['nullable', 'numeric', 'min:0'],
            'monthly_savings_goal'       => ['nullable', 'numeric', 'min:0'],
        ]);

        $user->update($validated);

        return back()->with('status', 'Your profile has been updated.');
    }
}