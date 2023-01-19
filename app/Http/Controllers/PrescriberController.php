<?php

namespace App\Http\Controllers;

use App\Prescriber;
use Illuminate\Http\Request;

class PrescriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prescribers = Prescriber::get();
        return view("Prescribers.index", compact('prescribers'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prescriber  $prescriber
     * @return \Illuminate\Http\Response
     */
    public function show(Prescriber $prescriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prescriber  $prescriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Prescriber $prescriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prescriber  $prescriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescriber $prescriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prescriber  $prescriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescriber $prescriber)
    {
        //
    }
}
