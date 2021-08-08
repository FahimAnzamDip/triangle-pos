<?php

namespace Modules\PurchasesReturn\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PurchaseReturnPaymentsController extends Controller
{

    public function index()
    {
        return view('purchasesreturn::index');
    }


    public function create()
    {
        return view('purchasesreturn::create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('purchasesreturn::show');
    }


    public function edit($id)
    {
        return view('purchasesreturn::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
