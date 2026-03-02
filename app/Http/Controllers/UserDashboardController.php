<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil riwayat donasi user
        $donations = Donation::with('campaign')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        // Hitung total donasi berhasil
        $totalDonation = Donation::where('user_id', $user->id)
            ->where('status', 'success')
            ->sum('amount');

        // Hitung jumlah campaign yang dibantu
        $campaignCount = Donation::where('user_id', $user->id)
            ->where('status', 'success')
            ->distinct('campaign_id')
            ->count();

        return view('landing_page.user.dashboard', compact('donations', 'totalDonation', 'campaignCount'));
    }

    public function certificate(Donation $donation)
    {
        // Pastikan donasi milik user yang sedang login dan sudah sukses
        if ($donation->user_id !== Auth::id() || $donation->status !== 'success') {
            abort(403, 'Sertifikat tidak tersedia.');
        }

        return view('landing_page.user.certificate', compact('donation'));
    }
}
