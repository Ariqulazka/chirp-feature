<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chirp;
use App\Models\Report;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->hasRole('admin')) {
            // Filter waktu
            $timeFrame = $request->get('time_frame', 'daily');
            $timeLimit = now()->sub($this->getTimeFrame($timeFrame));

            // Hitung statistik
            $activeUsers = User::where('last_active_at', '>=', $timeLimit)->count();
            $chirpsCount = Chirp::where('created_at', '>=', $timeLimit)->count();
            $reportCount = Report::where('created_at', '>=', $timeLimit)->count();

            // Kirim data ke view
            return view('dashboard', compact('activeUsers', 'chirpsCount', 'reportCount', 'timeFrame'));
        }

        // Untuk user biasa
        return view('dashboard');
    }

    private function getTimeFrame($timeFrame)
    {
        return match ($timeFrame) {
            'daily' => '1 day',
            'weekly' => '1 week',
            'monthly' => '1 month',
            default => '1 day',
        };
    }
}


