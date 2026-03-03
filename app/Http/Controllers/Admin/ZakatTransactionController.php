<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZakatPayment;
use Illuminate\Http\Request;

class ZakatTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = ZakatPayment::with('zakat', 'user')->latest();

        if ($request->has('search')) {
            $query->where('transaction_id', 'like', '%' . $request->search . '%')
                  ->orWhere('payer_name', 'like', '%' . $request->search . '%');
        }

        $transactions = $query->paginate(10);
        return view('admin.zakat_transactions.index', compact('transactions'));
    }

    public function confirm(ZakatPayment $payment)
    {
        if ($payment->status !== 'success') {
            $payment->update(['status' => 'success']);
            $payment->zakat->increment('collected_amount', $payment->amount);

            return back()->with('success', 'Transaksi zakat berhasil dikonfirmasi manual!');
        }

        return back()->with('error', 'Transaksi sudah berstatus sukses.');
    }

    public function destroy(ZakatPayment $payment)
    {
        $payment->delete();
        return back()->with('success', 'Data transaksi zakat dihapus.');
    }
}
