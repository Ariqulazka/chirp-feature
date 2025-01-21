<?php

// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    // Melaporkan konten
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'reported_id' => 'required|integer',
            'reported_type' => 'required|string',
            'reason' => 'required|string|max:500',
        ]);

        // Simpan laporan, termasuk reporter_id
        $report = Report::create([
            'reported_id' => $request->reported_id,
            'reported_type' => $request->reported_type,
            'reason' => $request->reason,
            'reporter_id' => auth()->id(), // Menggunakan ID pengguna yang sedang login
        ]);

        // Redirect atau response sesuai kebutuhan
        return redirect()->back()->with('status', 'Report submitted successfully');
    }

    // Menampilkan laporan yang belum ditinjau
    public function index()
{
    $reports = Report::with(['reporter', 'reported'])->get(); // Pastikan relasi diload dengan benar

    return view('admin.reports.index', compact('reports'));
}
    // Menangani laporan yang sudah diterima
    public function action(Request $request, Report $report)
    {
        Gate::authorize('update', $report); // Memastikan hanya admin yang bisa mengambil tindakan

        if ($request->action === 'delete') {
            // Hapus konten yang dilaporkan
            $report->reported->delete();
        } elseif ($request->action === 'deactivate') {
            // Nonaktifkan akun pengguna
            if ($report->reported_type === 'user') {
                $user = User::find($report->reported_id);
                $user->update(['is_active' => false]);
            }
        }
        $report->update(['is_reviewed' => true]);
        return back()->with('status', 'Action completed successfully!');
    }
}

