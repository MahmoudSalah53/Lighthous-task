<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function adminIndex()
    {
        if (auth()->user()->isAdmin()) {
            $submissions = Submission::with('user')->paginate(4);
            return view('submissions', compact('submissions'));
        }

        return redirect(route('dashboard'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'country' => 'required|string|max:255',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'comments' => 'nullable|string',
        ]);

        $fileNames = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('submissions', 'public');
                $fileNames[] = $path;
            }
        }

        Submission::create([
            'user_id' => Auth::id(),
            'contact_email' => $validated['contact_email'],
            'contact_phone' => $validated['contact_phone'],
            'birth_date' => $validated['birth_date'],
            'gender' => $validated['gender'],
            'country' => $validated['country'],
            'files' => json_encode($fileNames),
            'comments' => $validated['comments'] ?? null,
        ]);

        return response()->json(['message' => 'Application submitted successfully']);
    }
}
