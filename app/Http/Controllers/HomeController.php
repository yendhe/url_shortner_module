<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortenedUrl;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $shortenedUrls = ShortenedUrl::all();
        return view('home', compact('shortenedUrls'));
    }

    public function getByid($id)
    {
        $shortenedUrl = ShortenedUrl::findOrFail($id);
        return view('edit', compact('shortenedUrl'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortenedUrl = ShortenedUrl::findOrFail($id);
        $shortenedUrl->update(['original_url' => $request->original_url]);
        return response()->json([
            'success' => 'URL Updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $shortenedUrl = ShortenedUrl::findOrFail($id);
        $shortenedUrl->delete();

        return response()->json([
            'success' => 'Deleted successfully.'
        ]);
    }

    public function deactivate($id)
    {
        $shortenedUrl = ShortenedUrl::findOrFail($id);
        $shortenedUrl->deactivated = true; // Set the deactivated flag
        $shortenedUrl->save();

        return response()->json([
            'success' => 'URL Deactivated successfully.'
        ]);
    }
}
