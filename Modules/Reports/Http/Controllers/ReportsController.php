<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class ReportsController extends Controller
{

    public function __construct() {
        abort_if(Gate::denies('access_reports'), 403);
    }

    public function profitLossReport() {
        return view('reports::profit-loss.index');
    }

    public function paymentsReport() {
        return view('reports::payments.index');
    }

    public function salesReport() {
        return view('reports::sales.index');
    }

    public function purchasesReport() {
        return view('reports::purchases.index');
    }

    public function salesReturnReport() {
        return view('reports::sales-return.index');
    }

    public function purchasesReturnReport() {
        return view('reports::purchases-return.index');
    }
}
