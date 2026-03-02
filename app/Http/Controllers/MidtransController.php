<?php

namespace App\Http\Controllers;

use App\Models\Donation;
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
            $type = $notification->payment_type;
            $orderId = $notification->order_id;
            $fraud = $notification->fraud_status;

            $donation = Donation::where('transaction_id', $orderId)->first();

            if (!$donation) {
                return response()->json(['message' => 'Donation not found'], 404);
            }

            if ($status == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $donation->update(['status' => 'pending']);
                    } else {
                        $this->markAsSuccess($donation);
                    }
                }
            } elseif ($status == 'settlement') {
                $this->markAsSuccess($donation);
            } elseif ($status == 'pending') {
                $donation->update(['status' => 'pending']);
            } elseif ($status == 'deny' || $status == 'expire' || $status == 'cancel') {
                $donation->update(['status' => 'failed']);
            }

            return response()->json(['message' => 'Success']);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    private function markAsSuccess($donation)
    {
        if ($donation->status !== 'success') {
            $donation->update(['status' => 'success']);
            
            // Update jumlah terkumpul di campaign
            $campaign = $donation->campaign;
            $campaign->increment('collected_amount', $donation->amount);
        }
    }
}
