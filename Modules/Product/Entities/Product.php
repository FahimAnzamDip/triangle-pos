<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{

    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    protected $with = ['media'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('images')
            ->useFallbackUrl('/images/fallback_product_image.png');
    }

    public function setProductCostAttribute($value) {
        $this->attributes['product_cost'] = ($value * 100);
    }

    public function getProductCostAttribute($value) {
        return ($value / 100);
    }

    public function setProductPriceAttribute($value) {
        $this->attributes['product_price'] = ($value * 100);
    }

    public function getProductPriceAttribute($value) {
        return ($value / 100);
    }
}
