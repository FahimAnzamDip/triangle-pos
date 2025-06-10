<?php

namespace Modules\Quotation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Quotation\Emails\QuotationMail;
use Modules\Quotation\Entities\Quotation;

class SendQuotationEmailController extends Controller
{
    public function __invoke(Quotation $quotation) {
        try {
            Mail::to($quotation->customer->customer_email)->send(new QuotationMail($quotation));

            $quotation->update([
                'status' => 'Sent'
            ]);

            toast(__('controller_messages.sent_on', ['email' => $quotation->customer->customer_email]), 'success');

        } catch (\Exception $exception) {
            Log::error($exception);
            toast(__('controller_messages.something_went_wrong'), 'error');
        }

        return back();
    }
}
