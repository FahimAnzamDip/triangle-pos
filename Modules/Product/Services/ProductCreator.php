<?php

namespace Modules\Product\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;

class ProductCreator
{
    /**
     * Create or retrieve a category by code and name.
     */
    public function getOrCreateCategory(string $categoryCode, string $categoryName): Category
    {
        return Category::firstOrCreate(
            ['category_code' => $categoryCode],
            ['category_name' => $categoryName]
        );
    }

    /**
     * Create a product with the provided attributes and optionally attach an image from URL.
     * Returns the created Product or null if it already exists or fails.
     */
    public function createProduct(array $attributes, ?string $imageUrl = null): ?Product
    {
        // Skip if product_code already exists
        if (isset($attributes['product_code']) && Product::where('product_code', $attributes['product_code'])->exists()) {
            return null;
        }

        return DB::transaction(function () use ($attributes, $imageUrl) {
            $product = Product::create($attributes);

            if ($imageUrl) {
                try {
                    // Prefer direct URL ingestion to avoid temp storage
                    $product->addMediaFromUrl($imageUrl)->toMediaCollection('images');
                } catch (\Throwable $e) {
                    // Ignore image failures and proceed with product creation
                }
            }

            return $product;
        });
    }

    /**
     * Helper that maps a JSON item (from your existing feed) to product attributes.
     * Expected keys: nama_barang, kode_dept, kode_barcode, harga_beli, stock_on_hand, kode_toko
     */
    public function mapJsonItemToAttributes(array $item, int $categoryId): array
    {
        $productNameBase = trim(($item['nama_barang'] ?? '') . ' ' . ($item['kode_dept'] ?? ''));

        return [
            'category_id' => $categoryId,
            'product_name' => $productNameBase,
            'product_code' => (string)($item['kode_barcode'] ?? ''),
            'product_barcode_symbology' => 'EAN13',
            'product_quantity' => (int)($item['stock_on_hand'] ?? 0),
            'product_cost' => (float)($item['harga_beli'] ?? 0),
            'product_price' => (float)($item['harga_beli'] ?? 0),
            'product_unit' => 'PC',
            'product_stock_alert' => 0,
            'product_order_tax' => null,
            'product_tax_type' => null,
            'product_note' => null,
        ];
    }
}


