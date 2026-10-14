<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = [
            'site_name',
            'tagline',
            'contact_email',
            'contact_phone',
            'address',
            'about_text',
            'footer_copyright',
            'breaking_enabled',
            'social_facebook',
            'social_twitter',
            'social_instagram',
            'social_youtube',
            'social_linkedin',
        ];

        foreach ($keys as $key) {
            Setting::set($key, $request->input($key, ''));
        }

        return back()->with('success', 'Site settings updated successfully!');
    }
}
