<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chirp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminChirpController extends Controller
{
    public function index()
    {
        $chirps = Chirp::with('user')->latest()->paginate(10);
        return view('admin.chirps.index', compact('chirps'));
    }

    public function destroy(Chirp $chirp)
    {
        $chirp->delete();
        return redirect()->route('admin.chirps.index')->with('status', 'Chirp deleted successfully.');
    }

    public function markForReview(Chirp $chirp)
    {
        // Update the chirp's review status
        $chirp->update([
            'is_reviewed' => true, // Set to true to mark as reviewed
        ]);
    
        // Redirect back with a success message
        return redirect()->back()->with('status', 'Chirp has been marked as reviewed!');
    }
    

}