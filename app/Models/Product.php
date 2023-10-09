<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];




    //warehouses
    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class)->withPivot('quantity');
    }
}
