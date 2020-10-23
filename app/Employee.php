<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public function customers() {
        return $this->hasMany(Customer::class, 'salesRepEmployeeNumber');
    }
}
