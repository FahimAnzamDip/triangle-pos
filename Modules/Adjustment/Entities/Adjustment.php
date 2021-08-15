<?php

namespace Modules\Adjustment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Adjustment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getDateAttribute($value) {
        return Carbon::parse($value)->format('d M, Y');
    }

    public function adjustedProducts() {
        return $this->hasMany(AdjustedProduct::class, 'adjustment_id', 'id');
    }

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $number = Adjustment::max('id') + 1;
            $model->reference = make_reference_id('ADJ', $number);
        });
    }

}
