<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function orders() {
        return $this->hasMany(Order::class, 'customerNumber');
    }

    public function saleRep() {
        return $this->belongsTo(Employee::class, 'salesRepEmployeeNumber');
    }
}
