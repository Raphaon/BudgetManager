<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
class CompteController extends Controller
{
    //

    function index()
    {
    	$comptes = Compte::where('isDelete', 0)->get();
    	
    	return view('Compte/index', compact('comptes'));
    }
}
