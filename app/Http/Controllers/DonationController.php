<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class DonationController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function create(Campaign $campaign)
    {
        return view('landing_page.donasi.payment', compact('campaign'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'donor_name' => Auth::check() ? 'nullable' : 'required|string|max:255',
            'email' => Auth::check() ? 'nullable' : 'required|email',
        ]);

        $transactionId = 'NF-' . strtoupper(Str::random(10));
        $donorName = Auth::check() ? Auth::user()->name : $request->donor_name;
        $donorEmail = Auth::check() ? Auth::user()->email : $request->email;

        // Simpan data donasi ke database (status pending)
        $donation = Donation::create([
            'user_id' => Auth::id(),
            'campaign_id' => $campaign->id,
            'transaction_id' => $transactionId,
            'amount' => $request->amount,
            'donor_name' => $donorName,
            'notes' => $request->notes,
            'status' => 'pending',
            'is_anonymous' => $request->has('is_anonymous')
        ]);

        // Payload Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $transactionId,
                'gross_amount' => (int) $request->amount,
            ],
            'customer_details' => [
                'first_name' => $donorName,
                'email' => $donorEmail,
            ],
            'item_details' => [
                [
                    'id' => $campaign->id,
                    'price' => (int) $request->amount,
                    'quantity' => 1,
                    'name' => 'Donasi: ' . Str::limit($campaign->title, 40),
                ]
            ],
            // Batasi hanya BSI
            'enabled_payments' => ['bank_transfer'],
            'bank_transfer' => [
                'bank' => 'bsi'
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json([
                'snap_token' => $snapToken,
                'donation_id' => $donation->id,
                'transaction_id' => $transactionId
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Donation $donation)
    {
        // Izinkan success atau pending agar tidak langsung dilempar ke dashboard
        if (!in_array($donation->status, ['success', 'pending'])) {
            return redirect()->route('dashboard');
        }

        // Ambil 3 rekomendasi campaign lain secara acak
        $recommendations = Campaign::where('status', 'active')
            ->where('id', '!=', $donation->campaign_id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('landing_page.donasi.success', compact('donation', 'recommendations'));
    }
}
