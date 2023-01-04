<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\typeProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::join("typeproduct", "typeproduct.codeType", "=","product.productTypeReff")
        ->get();
        $typeProducts = typeProduct::get();
        return view('Products/products', compact('products', "typeProducts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $msg = "Echec de l'opération ";
        $product = new Product;
        $product->productCode = request('codeproduct');
        $product->Designation = request('designation');
        $product->purchasePrice = request('purchasingPrice');
        $product->sellingPrice = request('priceOfSaling');
        $product->marque = request('brand');
        $product->description = request('description');
        $product->color = request('color');
        $product->productTypeReff = request('typeProd');
        if($product->save()){
            $msg = "Opération reussi !";
        }
      return redirect()->back()->with($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }



    public function pointOfSale(){
        $products = Product::join("typeproduct", "typeproduct.codeType", "=","product.productTypeReff")
        ->get();
        $typeProducts = typeProduct::get();

        return view('./Pos/pointOfSale', compact('products', "typeProducts"));
    }
}
