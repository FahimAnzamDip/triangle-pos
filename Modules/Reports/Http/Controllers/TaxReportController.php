<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Sale\Entities\Sale;
use Carbon\Carbon;

class TaxReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('access_reports'), 403);

        return view('reports::tax-report.index');
    }

    public function export(Request $request)
    {
        abort_if(Gate::denies('access_reports'), 403);

        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2020|max:2030',
        ]);

        $month = $request->input('month');
        $year = $request->input('year');

        // Get all completed sales for the specified month and year
        $sales = Sale::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->where('status', 'Completed')
            ->orderBy('date', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        if ($sales->isEmpty()) {
            return back()->with('error', 'No completed sales found for the selected month and year.');
        }

        // Process sales data for XML export
        $processedSales = $this->processSalesForXml($sales);

        // Generate XML content
        $xmlContent = view('reports::tax-report.xml-template', [
            'month' => $month,
            'year' => $year,
            'sales' => $processedSales
        ])->render();

        // Set filename
        $filename = "retail_invoice_bulk_{$year}_" . sprintf('%02d', $month) . ".xml";

        // Return XML file download
        return response($xmlContent)
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }

    private function processSalesForXml($sales)
    {
        $processedSales = [];
        $serialNo = 1;

        foreach ($sales as $sale) {
            // Convert amounts from cents to actual values
            $totalAmount = $sale->getRawOriginal('total_amount'); // Get raw value in cents
            $taxBaseSellingPrice = $totalAmount * 0.01; 
            $otherTaxBaseSellingPrice = $taxBaseSellingPrice * 0.1;
            $vat = $otherTaxBaseSellingPrice * 0.11;

            $processedSales[] = [
                'serial_no' => $serialNo,
                'transaction_date' => Carbon::parse($sale->date)->format('Y-m-d'),
                'buyer_name' => $sale->customer_name,
                'tax_base_selling_price' => $taxBaseSellingPrice,
                'other_tax_base_selling_price' => $otherTaxBaseSellingPrice,
                'vat' => $vat,
            ];

            $serialNo++;
        }

        return $processedSales;
    }
} 