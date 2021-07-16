<?php

namespace Modules\Product\Http\Controllers;

use App\DataTables\ProductDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Entities\Product;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Modules\Product\Http\Requests\ProductUpdateRequest;
use Modules\Upload\Entities\Upload;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ProductDataTable $dataTable) {
        return $dataTable->render('product::products.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('product::products.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ProductCreateRequest $request) {
        $product = Product::create($request->except('image'));

        if ($request->has('image')) {
            $tempFile = Upload::where('folder', $request->image)->first();

            if ($tempFile) {
                $product->addMedia(Storage::path('public/temp/' . $request->image . '/' . $tempFile->filename))->toMediaCollection();

                Storage::deleteDirectory('public/temp/' . $request->image);
                $tempFile->delete();
            }
        }

        toast('Product Created!', 'success');

        return redirect()->route('products.index');
    }

    /**
     * Show the details for the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Product $product) {
        return view('product::products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Product $product) {
        return view('product::products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ProductUpdateRequest $request, Product $product) {
        $product->update($request->except('image'));

        if ($request->has('image')) {
            $tempFile = Upload::where('folder', $request->image)->first();

            $media = $product->getMedia();
            $media[0]->delete();

            if ($tempFile) {
                $product->addMedia(Storage::path('public/temp/' . $request->image . '/' . $tempFile->filename))->toMediaCollection();

                Storage::deleteDirectory('public/temp/' . $request->image);
                $tempFile->delete();
            }
        }

        toast('Product Updated!', 'info');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Product $product) {
        $product->delete();

        toast('Product Deleted!', 'warning');

        return redirect()->route('products.index');
    }
}
