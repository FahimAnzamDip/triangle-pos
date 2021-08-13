<?php

namespace Modules\Setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreSmtpSettingsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mail_mailer'           => 'required|string|max:50',
            'mail_host'             => 'required|string|max:50',
            'mail_port'             => 'required|numeric',
            'mail_username'         => 'nullable|string|max:50',
            'mail_password'         => 'nullable|string|max:50',
            'mail_encryption'       => 'nullable|string|max:50',
            'mail_from_address'       => 'nullable|string|max:50',
            'mail_from_name'       => 'required|string|max:50',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('access_settings');
    }
}
