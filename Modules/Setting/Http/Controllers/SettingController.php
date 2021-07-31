<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Setting\Entities\Setting;

class SettingController extends Controller
{

    public function index() {
        abort_if(Gate::denies('access_settings'), 403);

        $settings = Setting::firstOrFail();

        return view('setting::index', compact('settings'));
    }


    public function update(Request $request) {
        abort_if(Gate::denies('access_settings'), 403);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'company_phone' => 'required|string|max:255',
            'notification_email' => 'required|email|max:255',
            'company_address' => 'required|string|max:500',
            'default_currency_id' => 'required|numeric',
            'default_currency_position' => 'required|string|max:255',
            'footer_text' => 'required|string|max:255'
        ]);

        Setting::firstOrFail()->update([
            'company_name' => $request->company_name,
            'company_email' => $request->company_email,
            'company_phone' => $request->company_phone,
            'notification_email' => $request->notification_email,
            'company_address' => $request->company_address,
            'default_currency_id' => $request->default_currency_id,
            'default_currency_position' => $request->default_currency_position,
            'footer_text' => $request->footer_text
        ]);

        toast('Settings Updated!', 'info');

        return redirect()->route('settings.index');
    }
}
