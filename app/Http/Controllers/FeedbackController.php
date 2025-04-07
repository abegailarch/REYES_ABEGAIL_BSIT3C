<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // ✅ Correct import

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $response = Http::post('https://hook.eu2.make.com/4g7jamv72j0ww7dpr0heq56qo1llx6pr', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        return response()->json([
            'message' => $response->successful()
                ? 'Thank you for your feedback!'
                : 'Failed to submit feedback',
            'success' => $response->successful(),
        ], $response->status());
    }
}
