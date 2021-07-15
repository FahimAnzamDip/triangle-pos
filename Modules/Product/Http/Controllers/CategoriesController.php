<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Category;
use App\DataTables\ProductCategoriesDataTable;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ProductCategoriesDataTable $dataTable) {
        return $dataTable->render('product::categories.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        $request->validate([
            'category_code' => 'required|unique:categories,category_code',
            'category_name' => 'required'
        ]);

        Category::create([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
        ]);

        toast('Product Category Created!', 'success');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id) {
        $category = Category::findOrFail($id);

        return view('product::categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id) {
        $request->validate([
            'category_code' => 'required|unique:categories,category_code,' . $id,
            'category_name' => 'required'
        ]);

        Category::findOrFail($id)->update([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
        ]);

        toast('Product Category Updated!', 'info');

        return redirect()->route('product-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id) {
        $category = Category::findOrFail($id);

        if ($category->products->isNotEmpty()) {
            return back()->withErrors('Can\'t delete beacuse there are products associated with this category.');
        }

        $category->delete();

        toast('Product Category Deleted!', 'warning');

        return redirect()->route('product-categories.index');
    }
}
