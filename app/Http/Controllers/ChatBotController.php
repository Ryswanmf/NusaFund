<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatBotController extends Controller
{
    /**
     * Menangani pesan dari user menggunakan Gemini API.
     */
    public function message(Request $request)
    {
        $userMessage = $request->message;
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'reply' => "Maaf, konfigurasi AI belum lengkap. Silakan hubungi admin."
            ]);
        }

        // 1. Ambil data dari database untuk konteks AI
        $settings = Setting::first();
        $campaigns = Campaign::where('status', 'active')->latest()->take(5)->get();
        $faqs = Faq::all();

        // 2. Susun System Prompt (Instruksi Dasar AI)
        $systemPrompt = "Anda adalah NusaBot, asisten virtual ramah dari NusaFund, platform donasi dan zakat terpercaya di Indonesia.\n\n";
        $systemPrompt .= "Informasi Organisasi:\n";
        $systemPrompt .= "- Alamat: " . ($settings->address ?? "Indonesia") . "\n";
        $systemPrompt .= "- Email: " . ($settings->email ?? "kontak@nusafund.org") . "\n";
        $systemPrompt .= "- WhatsApp: " . ($settings->phone ?? "+62") . "\n\n";

        $systemPrompt .= "Campaign Aktif Saat Ini:\n";
        foreach ($campaigns as $camp) {
            $systemPrompt .= "- " . $camp->title . " (Kategori: " . $camp->category . ", Target: Rp " . number_format($camp->target_amount, 0, ',', '.') . ")\n";
        }
        $systemPrompt .= "\nFAQ Singkat:\n";
        foreach ($faqs as $f) {
            $systemPrompt .= "Q: " . $f->question . " | A: " . $f->answer . "\n";
        }

        $systemPrompt .= "\nATURAN JAWABAN:\n";
        $systemPrompt .= "1. Jawablah dengan bahasa Indonesia yang sopan dan hangat.\n";
        $systemPrompt .= "2. Jika ditanya tentang donasi, sarankan campaign yang aktif di atas.\n";
        $systemPrompt .= "3. Jika ditanya cara kerja, jelaskan: Pilih campaign, klik 'Donasi Sekarang', pilih metode pembayaran, dan konfirmasi.\n";
        $systemPrompt .= "4. Jika tidak tahu, sarankan untuk menghubungi admin via WhatsApp: " . ($settings->phone ?? "") . ".\n";
        $systemPrompt .= "5. Jawablah dengan singkat dan padat (maksimal 3 paragraf).";

        try {
            // 3. Panggil API Gemini
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => "Instruksi Sistem: " . $systemPrompt . "\n\nUser: " . $userMessage]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 800,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? "Maaf, saya sedang tidak bisa merespon.";
                
                return response()->json(['reply' => $reply]);
            }

            Log::error('Gemini API Error: ' . $response->body());
            return $this->fallbackLogic($userMessage);

        } catch (\Exception $e) {
            Log::error('ChatBot Exception: ' . $e->getMessage());
            return $this->fallbackLogic($userMessage);
        }
    }

    /**
     * Logika cadangan jika API Gemini bermasalah.
     */
    private function fallbackLogic($message)
    {
        $message = strtolower($message);
        if (str_contains($message, 'halo')) return response()->json(['reply' => "Halo! Ada yang bisa NusaBot bantu?"]);
        if (str_contains($message, 'donasi')) return response()->json(['reply' => "Silakan pilih menu 'Donasi' untuk melihat program bantuan kami."]);
        
        return response()->json([
            'reply' => "Maaf, sistem AI sedang sibuk. Silakan coba lagi nanti atau hubungi WhatsApp admin kami."
        ]);
    }
}
