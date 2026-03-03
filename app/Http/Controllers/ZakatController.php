<?php

namespace App\Http\Controllers;

use App\Models\Zakat;
use App\Models\ZakatPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZakatController extends Controller
{
    // --- ADMIN FUNCTIONS ---
    public function index(Request $request)
    {
        $query = Zakat::latest();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $zakats = $query->paginate(10);
        return view('admin.zakat.index', compact('zakats'));
    }

    public function create()
    {
        return view('admin.zakat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'institution' => 'required|string',
            'asnaf_category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->all();
        $data['status'] = $request->status ?? 'active';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('zakats', 'public');
        }

        Zakat::create($data);

        return redirect()->route('admin.zakat.index')->with('success', 'Program Zakat berhasil dibuat!');
    }

    public function edit(Zakat $zakat)
    {
        return view('admin.zakat.edit', [
            'zakat' => $zakat
        ]);
    }

    public function update(Request $request, Zakat $zakat)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'institution' => 'required|string',
            'asnaf_category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($zakat->image && Storage::disk('public')->exists($zakat->image)) {
                Storage::disk('public')->delete($zakat->image);
            }
            $data['image'] = $request->file('image')->store('zakats', 'public');
        }

        $zakat->update($data);

        return redirect()->route('admin.zakat.index')->with('success', 'Program Zakat berhasil diperbarui!');
    }

    public function destroy(Zakat $zakat)
    {
        if ($zakat->image && Storage::disk('public')->exists($zakat->image)) {
            Storage::disk('public')->delete($zakat->image);
        }
        $zakat->delete();

        return redirect()->route('admin.zakat.index')->with('success', 'Program Zakat berhasil dihapus!');
    }

    // --- PUBLIC FUNCTIONS ---
    public function publicIndex(Request $request)
    {
        $query = Zakat::where('status', 'active')->latest();

        if ($request->has('category') && $request->category != 'Semua') {
            $query->where('asnaf_category', $request->category);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $zakats = $query->get();
        
        return view('landing_page.zakat.index', compact('zakats'));
    }

    public function publicShow($slug)
    {
        $zakat = Zakat::where('slug', $slug)->firstOrFail();
        return view('landing_page.zakat.pay', compact('zakat'));
    }

    public function pay(Request $request, Zakat $zakat)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'name' => \Illuminate\Support\Facades\Auth::check() ? 'nullable' : 'required|string|max:255',
            'email' => \Illuminate\Support\Facades\Auth::check() ? 'nullable' : 'required|email',
        ]);

        $transactionId = 'ZK-' . strtoupper(\Illuminate\Support\Str::random(10));
        $payerName = \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->name : $request->name;
        $payerEmail = \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->email : $request->email;

        // Simpan data pembayaran ke database
        ZakatPayment::create([
            'zakat_id' => $zakat->id,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'transaction_id' => $transactionId,
            'amount' => $request->amount,
            'payer_name' => $payerName,
            'payer_email' => $payerEmail,
            'phone' => $request->phone,
            'status' => 'pending'
        ]);

        // Midtrans Payload
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $transactionId,
                'gross_amount' => (int) $request->amount,
            ],
            'customer_details' => [
                'first_name' => $payerName,
                'email' => $payerEmail,
            ],
            'enabled_payments' => ['bank_transfer'],
            'bank_transfer' => ['bank' => 'bsi']
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return response()->json([
                'snap_token' => $snapToken,
                'transaction_id' => $transactionId
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success($transaction_id)
    {
        $payment = ZakatPayment::with('zakat')->where('transaction_id', $transaction_id)->firstOrFail();
        
        // Auto-success for local testing
        if ($payment->status === 'pending') {
            $payment->update(['status' => 'success']);
            $payment->zakat->increment('collected_amount', $payment->amount);
        }

        return view('landing_page.zakat.success', compact('payment'));
    }
}
