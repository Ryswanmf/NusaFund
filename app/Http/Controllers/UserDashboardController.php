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

    public function certificate($transaction_id)
    {
        $donation = Donation::with(['campaign', 'user'])
            ->where('transaction_id', $transaction_id)
            ->where('status', 'success')
            ->firstOrFail();

        // Tentukan nama donatur (User terdaftar atau Nama Tamu)
        $donorName = $donation->user ? $donation->user->name : $donation->donor_name;
        if ($donation->is_anonymous) $donorName = "Hamba Allah";

        return view('landing_page.user.certificate', compact('donation', 'donorName'));
    }
}
