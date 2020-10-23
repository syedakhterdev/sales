<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getAllCustomers() {
        $customers = Customer::get();
        return response()->json($customers);
    }
}
