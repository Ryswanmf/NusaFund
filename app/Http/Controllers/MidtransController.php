<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\ZakatPayment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        try {
            $notification = new Notification();
            
            $status = $notification->transaction_status;
            $orderId = $notification->order_id;

            // Deteksi jenis transaksi berdasarkan prefix ID
            if (str_starts_with($orderId, 'NF-')) {
                $this->handleDonation($orderId, $status);
            } elseif (str_starts_with($orderId, 'ZK-')) {
                $this->handleZakat($orderId, $status);
            }

            return response()->json(['message' => 'Success']);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    private function handleDonation($orderId, $status)
    {
        $donation = Donation::where('transaction_id', $orderId)->first();
        if (!$donation) return;

        if ($status == 'settlement' || $status == 'capture') {
            if ($donation->status !== 'success') {
                $donation->update(['status' => 'success']);
                $donation->campaign->increment('collected_amount', $donation->amount);
            }
        } elseif ($status == 'pending') {
            $donation->update(['status' => 'pending']);
        } else {
            $donation->update(['status' => 'failed']);
        }
    }

    private function handleZakat($orderId, $status)
    {
        $payment = ZakatPayment::where('transaction_id', $orderId)->first();
        if (!$payment) return;

        if ($status == 'settlement' || $status == 'capture') {
            if ($payment->status !== 'success') {
                $payment->update(['status' => 'success']);
                $payment->zakat->increment('collected_amount', $payment->amount);
            }
        } elseif ($status == 'pending') {
            $payment->update(['status' => 'pending']);
        } else {
            $payment->update(['status' => 'failed']);
        }
    }
}
