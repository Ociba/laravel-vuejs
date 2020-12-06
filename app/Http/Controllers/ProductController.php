<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function getProductPage(){
        return view('product');
    }
    public function save_product(){
        $product =new Product;
        $product->name =request()->name;
        $product->number=request()->number;
        $product->color =request()->color;
        $product->price =request()->price;
        $product->save();
        return 'ok';
    }
    public function getProduct(){
        $product =Product::paginate(10);
        return response()->json($product);
    }
    public function editProduct($id){
        $product =Product::find($id);
        return response()->json($product);
    }
    public function updateProduct(){
        $product =Product::find(request()->id);
        $product->name =request()->name;
        $product->number =request()->number;
        $product->color =request()->color;
        $product->price =request()->price;
        $product->update();
        return 'ok';
    }
    public function deleteProduct($id){
        $product =Product::find($id)->delete();
        return 'ok';
    }
}
