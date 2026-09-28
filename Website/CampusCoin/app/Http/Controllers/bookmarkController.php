<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::where('user_id', Auth::id())
            ->pluck('bookmark_key');

        return response()->json([
            'bookmarks' => $bookmarks,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bookmark' => 'required|string|max:100',
        ]);

        Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'bookmark_key' => $validated['bookmark'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bookmark saved successfully!',
        ]);
    }

    public function destroy(string $key)
    {
        Bookmark::where('user_id', Auth::id())
            ->where('bookmark_key', $key)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bookmark removed successfully!',
        ]);
    }
}