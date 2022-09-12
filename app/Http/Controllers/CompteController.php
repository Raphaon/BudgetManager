<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Ligne_mvt_Compte;
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

    public function getAccount($accountNumber)
    {
        return Compte::where('isDelete', 0)->where('numCompte', $accountNumber)->first();
    }
    function deposite()
    {
        $comptes = Compte::where('isDelete', 0)->get();
        return view('Compte.deposite', compact('comptes'));
    }

    function Virement($accountFrom, $accountTo)
    {
    }



    function history()
    {
        $comptes = Compte::where('isDelete', 0)->get();
        $dateDebutHistorique = "2020" . '-01-01';
        $dateFinHistorique = date('Y-M-d');

        $accountsMouvements = Ligne_mvt_Compte::whereBetween("date_mvt", [$dateDebutHistorique, $dateFinHistorique])
            ->where('ligne_mvt_compte.isDelete', 0)
            ->join('compte', 'compte.numCompte', '=', 'ligne_mvt_compte.reffCompte')
            ->get();
        return view('Compte.historique', compact('comptes', 'accountsMouvements'));
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

    public function transfer()
    {
        $comptes = Compte::where('isDelete', 0)->get();
        return view('Compte.virement', compact('comptes'));
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
