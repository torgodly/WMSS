<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];


    //warehouses
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    //products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
