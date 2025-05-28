<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClaimOnlineController extends Controller
{
    public function store(Request $request)
    {
        // Step 1: Validate request
        $validated = $request->validate([
            'policy_number' => 'required|string|max:255',
            'claim_type' => 'required|in:health,vehicle,property',
            'incident_date' => 'required|date',
            'description' => 'required|string',
            'documents' => 'required|array',
            'documents.*' => 'file|mimes:jpg,jpeg,png,pdf|max:9120', // 5MB
        ]);

        // Step 2: Upload files
        $filePaths = [];

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                if ($file->isValid()) {
                    $filename = 'claims_documents/' . uniqid() . '_' . $file->getClientOriginalName();
                    $path = Storage::disk('public')->put($filename, file_get_contents($file));

                    if ($path) {
                        $filePaths[] = [
                            'filename' => $filename,
                        ];
                    }
                }
            }
        }

        // Step 3: Save to DB
        $claim = new Claim();
        $claim->policy_number = $validated['policy_number'];
        $claim->claim_type = $validated['claim_type'];
        $claim->incident_date = $validated['incident_date'];
        $claim->description = $validated['description'];
        $claim->documents = json_encode($filePaths); // Save file info as JSON
        $claim->save();

        return redirect()->back()->with([
            'message' => 'Claim submitted successfully.',
            'filepaths' => $filePaths,
        ]);
    }
}
