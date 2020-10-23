<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLine extends Model
{
    protected $table = 'productlines';

    protected $fillable = ['productLine', 'textDescription','htmlDescription','image'];

    protected $primaryKey = 'productLine';
    public $incrementing = false;
    public $timestamps = false;
}
