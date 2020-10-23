<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $appends = ['full_name'];
    public function customers() {
        return $this->hasMany(Customer::class, 'salesRepEmployeeNumber');
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName);
    }
}
