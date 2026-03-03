<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Donation::with('campaign', 'user')->latest();

        if ($request->has('search')) {
            $query->where('transaction_id', 'like', '%' . $request->search . '%')
                  ->orWhere('donor_name', 'like', '%' . $request->search . '%');
        }

        $transactions = $query->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function confirm(Donation $donation)
    {
        if ($donation->status !== 'success') {
            $donation->update(['status' => 'success']);
            
            // Update total dana di campaign
            $campaign = $donation->campaign;
            $campaign->increment('collected_amount', $donation->amount);

            return back()->with('success', 'Donasi berhasil dikonfirmasi manual!');
        }

        return back()->with('error', 'Donasi sudah berstatus sukses.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return back()->with('success', 'Data transaksi berhasil dihapus.');
    }
}
