<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReportsController extends Controller
{
    public function salesReport() {
        return view('reports::sales.index');
    }

    public function purchasesReport() {
        return view('reports::purchases.index');
    }
}
