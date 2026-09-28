<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Support\Str;

class SavingTipsController extends Controller
{
    /**
     * Published "Saving Tip" rows go to $tips, published "Announcement"
     * rows go to $announcements (shown in their own section on the page).
     * Uses the real columns of the `contents` table: type, title, text, status.
     */
    public function index()
    {
        $tips          = $this->fetch('saving tip', '💡', 90);
        $announcements = $this->fetch('announcement', '📢', 400);

        return view('saving-tips', compact('tips', 'announcements'));
    }

    private function fetch(string $type, string $icon, int $descLimit)
    {
        return Content::query()
            ->whereRaw('LOWER(TRIM(type)) = ?', [$type])
            ->whereRaw('LOWER(TRIM(status)) = ?', ['published'])
            ->latest()
            ->get()
            ->map(fn ($c) => [
                'id'     => $c->id,
                'icon'   => $icon,
                'title'  => (string) $c->title,
                'desc'   => Str::limit(strip_tags((string) $c->text), $descLimit),
                'detail' => (string) $c->text,
                'is_new' => optional($c->created_at)->gte(now()->subDays(7)) ?? false,
            ])
            ->values();
    }
}