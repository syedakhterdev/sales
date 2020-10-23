<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\ProductLine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function getAllProduct() {
        $products = Product::get();
        return response()->json($products);
    }
   
    public function productLine() {
        $products = ProductLine::get();
        return response()->json($products);
    }

    public function insert(Request $request) {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->errors()->count()) {
            return response()->json($validation->messages()->all(), 422);
        }
        $product = new Product();
        $product->productCode = uniqid();
        $product->productScale = $request->productScale;
        $product->productName = $request->productName;
        $product->productDescription = $request->productDescription;
        $product->productLine = $request->productLine;
        $product->productVendor = $request->productVendor;
        $product->quantityInStock = $request->quantityInStock;
        $product->buyPrice = $request->buyPrice;
        $product->MSRP = $request->MSRP;
        $product->save();
        return response()->json($product);
    }

    public function update(Request $request) {
        $validation = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validation->errors()->count()) {
            return response()->json($validation->messages()->all(), 422);
        }
        $product = Product::where('productCode',$request->productCode)->first();
        $product->productScale = $request->productScale;
        $product->productName = $request->productName;
        $product->productDescription = $request->productDescription;
        $product->productLine = $request->productLine;
        $product->productVendor = $request->productVendor;
        $product->quantityInStock = $request->quantityInStock;
        $product->buyPrice = $request->buyPrice;
        $product->MSRP = $request->MSRP;
        $product->save();
        return response()->json($product);
    }

    private function rules() {
        return [
            'productName'       =>  'required',
            'productLine'       =>  'required',
            'productVendor'     => 'required',
            'productScale'      => 'required',
            'productDescription' => 'required',
            'quantityInStock'   => 'required',
            'buyPrice'          => 'required',
            'MSRP'              => 'required',
        ];
    }

    private function messages(){
        return [
            'required'  =>  'The :attribute can not be blank.',
        ];
    }
}
