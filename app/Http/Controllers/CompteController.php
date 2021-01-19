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

    function Approv(){

    }

    function Virement($accountFrom ,$accountTo)
    {

    }

    function historique(){

    }

    public function create(){

    }

    public function update(){

    }

    public function withdraw()
    {
        
    }
}
