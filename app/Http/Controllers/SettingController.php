<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();
        
        $request->validate([
            'site_logo' => 'nullable|image|max:1024',
            'impact_image' => 'nullable|image|max:2048',
            'email' => 'required|email',
            'whatsapp' => 'required',
            'address' => 'required',
            'copyright' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('site_logo')) {
            if ($setting->site_logo && Storage::disk('public')->exists($setting->site_logo)) {
                Storage::disk('public')->delete($setting->site_logo);
            }
            $data['site_logo'] = $request->file('site_logo')->store('settings', 'public');
        }

        if ($request->hasFile('impact_image')) {
            if ($setting->impact_image && Storage::disk('public')->exists($setting->impact_image)) {
                Storage::disk('public')->delete($setting->impact_image);
            }
            $data['impact_image'] = $request->file('impact_image')->store('settings', 'public');
        }

        $setting->update($data);

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
