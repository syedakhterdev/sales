<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['customerName', 'contactLastName', 'contactFirstName', '','phone', 'addressLine1',
        'addressLine2', 'city', 'state ', 'postalCode', 'country', 'salesRepEmployeeNumber'];
    public function orders() {
        return $this->hasMany(Order::class, 'customerNumber');
    }

    public function saleRep() {
        return $this->belongsTo(Employee::class, 'salesRepEmployeeNumber');
    }
}
