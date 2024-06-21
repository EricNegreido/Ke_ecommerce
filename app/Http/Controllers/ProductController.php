<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        view('product.index', compact('products'));
        
    }
    public function create(Product $product){
        view('product.create', compact('product'));
                
    }
    public function store(Request $request){
        $request-> validate ([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);
        Product::create($request->all());

        return redirect()->route('product.index');     
    }
    public function edit(Product $product){
        return view('product.edit', compact('product'));
    }
    public function update(Request $request, Product $product){
        $request-> validate ([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);
        $product->update($request->all());

        return redirect()->route('product.index');  
    }
    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index');
    }
}
