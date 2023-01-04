<?php

namespace App\Http\Controllers;

use App\typeProduct;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeProducts = typeProduct::get();
        return view('./Products/typeProduct', compact('typeProducts'));
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
        $msg="Echec de l'opération !";

         $type_product = new typeProduct;
         $type_product->codeType = request("codeType");
         $type_product->label  = request('label');
         if($type_product->save()){
            $msg ="Opération reussi !";
         }
         return redirect()->back()->with($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\typeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function show(typeProduct $typeProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\typeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(typeProduct $typeProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\typeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, typeProduct $typeProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\typeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(typeProduct $typeProduct)
    {
        //
    }
}
