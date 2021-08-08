<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Product;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['product'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function purchase() {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }

    public function getPriceAttribute($value) {
        return $value / 100;
    }

    public function getUnitPriceAttribute($value) {
        return $value / 100;
    }

    public function getSubTotalAttribute($value) {
        return $value / 100;
    }

    public function getProductDiscountAmountAttribute($value) {
        return $value / 100;
    }

    public function getProductTaxAmountAttribute($value) {
        return $value / 100;
    }
}
