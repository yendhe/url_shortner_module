<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortenedUrl;
use App\Models\User;

class UrlController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showShortenForm()
    {
        return view('shorten');
    }

    public function shorten(Request $request)
    {
        $user = auth()->user();

        if ($user->shortenedUrls()->whereNull('deleted_at')->count() >= (($user->plan!='unlimited') ? $user->plan : 5000)) {
            return response()->json(['message' => 'You have reached the maximum limit for shortening URLs.']);
        }
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortCode = ShortenedUrl::generateUniqueShortCode();
        $shortenedUrl = ShortenedUrl::create([
            'user_id' => $user->id,
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
        ]);
        return response()->json([
            'shortened_url' => route('shorten.form', $shortCode),
            'message' => 'URL shortened successfully.'
        ]);
    }

    public function upgradeForm()
    {
        $user = auth()->user();
        $user_id = $user->id;
        $plans = User::findOrFail($user_id);
        return view('upgrade', compact('plans'));
    }

    public function upgrade(Request $request)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $request->validate([
            'plan' => 'required|string',
        ]);

        $plan = User::findOrFail($user_id);
        $plan->update(['plan' => $request->plan]);
        return response()->json([
            'success' => 'Plan Upgraded successfully.'
        ]);
    }

    public function redirect($shortCode)
    {
        $shortenedUrl = ShortenedUrl::where('short_code', $shortCode)->first();

        if (!$shortenedUrl) {
            abort(404);
        }
        return redirect($shortenedUrl->original_url);
    }
}
