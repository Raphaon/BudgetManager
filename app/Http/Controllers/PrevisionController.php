<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prevision;
use App\PostBudgetaire;
use DB;
use App\myFonction;

class PrevisionController extends Controller
{
    public function index(Request $request)
    {
        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }
        $codeExo = session("codeExo");
        $prevision = DB::table('prevision')
            ->leftJoin('postbudgetaire', 'postbudgetaire.numCompte', '=', 'prevision.codePostBudgetaire')
            ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
            ->join("agence", "agence.codeAg", '=', "exercice.agence")
            ->where('postbudgetaire.isDelete', 0)
            ->where('postbudgetaire.sensPost', 'Charge')
            ->where('prevision.exercicePrevi', $codeExo)
            ->get();


        return view("prevision.index", compact("prevision"));
    }

    public function create()
    {
        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }
        $post =  DB::table("postbudgetaire")->select('*')->whereNotIn('numCompte', function ($query) {
            $query->select('codePostbudgetaire')->from('prevision')
                ->where('exercicePrevi', session('codeExo'));
        })->where('isDelete', 0)
            ->get();

        $exercice = DB::table('exercice')
            ->where('isClose', 0)
            ->distinct('AnneeExercice')
            ->where('codeExercice', session('codeExo'))
            ->get();
        return view("prevision.new", compact("post", "exercice"));
    }


    public function update (Request $request){


        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }


        $idprev = request('idprev'); 

       $prevision = DB::table('prevision')
            ->leftJoin('postbudgetaire', 'postbudgetaire.numCompte', '=', 'prevision.codePostBudgetaire')
            ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
            ->join("agence", "agence.codeAg", '=', "exercice.agence")
            ->where('postbudgetaire.isDelete', 0)
            ->where('postbudgetaire.sensPost', 'Charge')
            ->where('prevision.exercicePrevi', session('codeExo'))
            ->where('prevision.idPrevision', $idprev)
            ->get();

//dd($prevision);
        $exercice = DB::table('exercice')
            ->where('isClose', 0)
            ->distinct('AnneeExercice')
            ->where('codeExercice', session('codeExo'))
            ->get();

        return view('./prevision.update', compact('prevision', 'exercice'));
    }




    public function store(Request $request)
    {
        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }
        $nbreprevi = Prevision::where("isDelete", 0)
            ->where('exercicePrevi', session('codeExo'))
            ->count();
        $nbreprevi++;
        $idprevi = "Previ" . session('BranchCode') . session("anneeExo") . date('s') . date('i') . date('n') . date('y');
        $previ =  new Prevision;
        $previ->idPrevision = $idprevi;
        $previ->observationPrevi = request("observationprevi");
        $previ->montantPrevision = request("montant");
        $previ->codePostBudgetaire = request("post");
        $previ->exercicePrevi = request("exercice");
        $previ->isDelete = 0;
        $previ->save();
        $msg = "Enregistrer avec succes !";
        return redirect()->back();
    }

    public function export()
    {
        return view("Prevision.export");
    }
    public function import()
    {
        return view("Prevision.importer");
    }



    public function importTraitement(Request $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        while (count($data) > 0) {
            // code || montant || exercice || Observation
            $dat  = array_shift($data);
            $ligne  = explode(';', $dat[0]);

            $nbreprevi = Prevision::where("isDelete", 0)
                ->where('exercicePrevi', session('codeExo'))
                ->count();
            $nbreprevi++;
            $idprevi = "Previ" . session('BranchCode') . session("anneeExo") . $nbreprevi;
            $previ =  new Prevision;
            $previ->idPrevision = $idprevi;
            $previ->observationPrevi = $ligne[3];
            $previ->montantPrevision = $ligne[1];
            $previ->codePostBudgetaire = $ligne[0];
            $previ->exercicePrevi = $ligne[2];
            $previ->isDelete = 0;
            $previ->save();
        }
        session()->flash('importSuccess', "Operation effectuer avec succes");
        return redirect()->back();
    }






    public function saveUpdate(Request $request){


        $previ= Prevision::where("idPrevision", request('idprevi'))
                ->where('isDelete', 0)
                ->update([
                    "montantPrevision" => htmlspecialchars(request("montant")),
                    "observationPrevi" => htmlspecialchars(request("observationprevi")),
                ]);

        if($previ)
        {
            session()->flash('UpdatePrevi', "Opérationde mise à jour effectué avec succes");
            return redirect()->back();
        }

    }


}
