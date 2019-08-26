<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexPostBudgetaire extends Controller
{
    //
    public function showIndex()
    {
        return view('Postbudgetaire/index');
    }
   
}
