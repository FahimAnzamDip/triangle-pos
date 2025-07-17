<?php

namespace Modules\Groups\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_code',
        'group_name',
        'group_type',
        'base_price',
        'cost_price',
    ];
} 