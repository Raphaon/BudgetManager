<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Exercice;
use Redirect;
use App\Agence;
use DB;
use App\myFonction;

class ExerciceController extends Controller
{
    public function index()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }

        $exercice = Exercice::where('statusExo','=', "Encours")
        ->where('codeExercice',session('codeExo'))
        ->where('isClose', 0)
        ->first();
      //  dd($exercice);
        return view("Exercice/index", compact('exercice') );
    }

    public function create(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $agence = Agence::where('isDelete','=', 0)->get();
        return view("Exercice/create", compact("agence"));
    }


    public function store(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $numexo = Exercice::where("isClose", 0)
        ->where('statusExo', 'Encours')
        ->count();
        if($numexo>0)
        {
            $nbre_exo_encour =   DB::table('exercice')
            ->where('statusExo', 'Encours')
            ->update([
            'statusExo'=> "EnCloture"
            ]);
        }
      $nbre_exo_encour =   DB::table('exercice')
            ->where('statusExo', 'Encours')
            ->update([
            'statusExo'=> "EnCloture"
            ]);


            if( !empty(request("codeExo")) and  !empty(request("anneeExo")) and  !empty(request("datedebutexo")) and  !empty(request("datefinexo")) and  !empty(request("agenceexo")) )

            {
                $exercice = new exercice;
                $exercice->codeExercice = request('codeExo');
                $exercice->AnneeExecice = request('anneeExo');
                $exercice->dateDebut = request('datedebutexo');
                $exercice->dateFin = request('datefinexo');
                $exercice->statusExo = "Encours";
                $exercice->agence = request('agenceexo');
                $exercice->save();
            }

            $agence = Agence::where("isDelete" ,0);
            $msg = "Exercice ouvert avec succes !";

            return redirect()->back();

    }

    public function close(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        return 'view("Exercice/close")';
    }

    public function delete(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        set_time_limit(300);
        $code = request("codeAg");
        $nom = request("nomAg");
        $region = request("regionAg");
        $typeAg = request('typeAg');
        DB::table('agence')
            ->where('codeAg', $code)
            ->where('nomAg', $nom)
            ->where('regionAg', $region)
            ->where('typeAg', $typeAg)
            ->update([
            'isDelete'=>1,
            ]);
        return  response()->json("reussi !!");
    }
}
