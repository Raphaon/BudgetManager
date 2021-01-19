<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;

class CompteController extends Controller
{
    //

    function index()
    {
        $comptes = Compte::where('isDelete', 0)->get();
        return view('Compte/index', compact('comptes'));
    }

    function Approv()
    {
    }

    function Virement($accountFrom, $accountTo)
    {
    }

    function historique()
    {
    }

    public function create()
    {
        return view('Compte/new');
    }

    public function update()
    {
    }

    public function withdraw()
    {
    }
    public function store(Request $request)
    {

        $request->validate([
            'accountNumber' => 'required|min:4',
            'accountName' => "required",
            'accountType' => 'required'
        ]);

        $compte  = new Compte();
        $compte->numCompte = request('accountNumber');
        $compte->libelle = request("accountName");
        $compte->typeCompte = request("accountType");
        $compte->description = request('observationAccount');
        $compte->isDelete = 0;

        Session::flash('msg', 'Erreur survenu lors de la creation du compte !');

        if ($compte->save()) {
            Session::flash('msg', 'Compte Crée avec succès !!');
        }
        return redirect()->route('newAccount');
    }
}
