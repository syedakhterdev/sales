<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['productCode', 'productName', 'productLine','productScale', 'productVendor',
    'productDescription', 'quantityInStock', 'buyPrice ', 'MSRP'];

    protected $primaryKey = 'productCode';
    public $incrementing = false;
    public $timestamps = false;
}
