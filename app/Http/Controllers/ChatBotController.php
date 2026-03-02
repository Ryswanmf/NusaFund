<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatBotController extends Controller
{
    public function message(Request $request)
    {
        $message = strtolower($request->message);
        $response = "";

        // Logika Sederhana berbasis Kata Kunci
        if (Str::contains($message, ['halo', 'hai', 'pagi', 'siang', 'sore', 'malam'])) {
            $response = "Halo! Saya NusaBot, asisten virtual Anda. Ada yang bisa saya bantu hari ini? Anda bisa tanya tentang 'donasi', 'zakat', atau 'cara kerja'.";
        } 
        elseif (Str::contains($message, ['donasi', 'campaign', 'bantu'])) {
            $campaigns = Campaign::where('status', 'active')->latest()->take(3)->get();
            if ($campaigns->count() > 0) {
                $response = "Tentu! Saat ini ada beberapa campaign yang sangat membutuhkan bantuan Anda:\n";
                foreach ($campaigns as $camp) {
                    $response .= "- " . $camp->title . " (Sisa: " . ceil(now()->diffInDays($camp->end_date)) . " hari lagi)\n";
                }
                $response .= "\nAnda bisa melihat selengkapnya di menu Donasi.";
            } else {
                $response = "Saat ini belum ada campaign aktif. Silakan cek kembali nanti ya!";
            }
        }
        elseif (Str::contains($message, ['zakat', 'tunaikan'])) {
            $response = "Zakat Anda sangat berarti bagi para asnaf. Kami menyediakan berbagai program zakat (Fitrah, Maal, Profesi). Anda bisa memilih program yang sesuai di menu Zakat.";
        }
        elseif (Str::contains($message, ['cara', 'bagaimana', 'kerja'])) {
            $response = "Caranya sangat mudah:\n1. Pilih Campaign\n2. Klik 'Donasi Sekarang'\n3. Pilih metode pembayaran\n4. Konfirmasi via WhatsApp kami. Sangat cepat dan aman!";
        }
        elseif (Str::contains($message, ['lokasi', 'alamat', 'dimana'])) {
            $setting = \App\Models\Setting::first();
            $response = "Kantor kami beralamat di: " . ($setting->address ?? "Jl. NusaFund No. 1, Indonesia");
        }
        elseif (Str::contains($message, ['terima kasih', 'thanks', 'oke'])) {
            $response = "Sama-sama! Senang bisa membantu Anda. Mari terus menebar kebaikan!";
        }
        else {
            // Coba cari di FAQ jika tidak ada kata kunci yang cocok
            $faq = Faq::where('question', 'like', '%' . $message . '%')->first();
            if ($faq) {
                $response = $faq->answer;
            } else {
                $response = "Maaf, saya belum memahami pertanyaan Anda. Bisa coba gunakan kata kunci lain seperti 'donasi' atau 'zakat'? Atau Anda bisa langsung chat admin kami via WhatsApp.";
            }
        }

        return response()->json([
            'reply' => $response
        ]);
    }
}
