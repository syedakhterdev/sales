<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function getAllCustomers() {
        $customers = Customer::get();
        return response()->json($customers);
    }

    public function update(Request $request) {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->errors()->count()) {
            return response()->json($validation->messages()->all(), 422);
        }

        Customer::where('customerNumber', $request->customerNumber)
        ->update([
            'customerName' => $request->customerName,
            'contactLastName' => $request->contactLastName,
            'contactFirstName' => $request->contactFirstName,
            'phone' => $request->phone,
            'addressLine1' => $request->addressLine1,
            'addressLine2' => $request->addressLine2,
            'city' => $request->city,
            'state' => $request->state,
            'postalCode' => $request->postalCode,
            'country' => $request->country,
            'salesRepEmployeeNumber' => $request->salesRepEmployeeNumber
        ]);

        return response()->json(['success' => true]);

    }

    public function store(Request $request) {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->errors()->count()) {
            return response()->json($validation->messages()->all(), 422);
        }

        $customer = Customer::create([
                'customerName' => $request->customerName,
                'contactLastName' => $request->contactLastName,
                'contactFirstName' => $request->contactFirstName,
                'phone' => $request->phone,
                'addressLine1' => $request->addressLine1,
                'addressLine2' => $request->addressLine2,
                'city' => $request->city,
                'state' => $request->state,
                'postalCode' => $request->postalCode,
                'country' => $request->country,
                'salesRepEmployeeNumber' => $request->salesRepEmployeeNumber
            ]);

        return response()->json(['success' => true, 'customer' => $customer]);
    }

    private function rules() {
        return [
            'customerName' =>  'required',
            'contactLastName'         =>  'required',
            'contactFirstName' => 'required',
            'phone' => 'required',
            'addressLine1' => 'required',
            'city' => 'required',
            'country' => 'required',

        ];
    }

    private function messages(){
        return [
            'required'  =>  'The :attribute can not be blank.',
        ];
    }
}
