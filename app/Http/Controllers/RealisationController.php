<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realisation;
use App\Models\Employe;
use App\exercice;
use App\myFonction;
use App\postbudgetaire;
use DB;
use PDF;
class RealisationController extends Controller
{
    public function index()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $realisation= DB::table('realisation')
        ->leftJoin('prevision', 'realisation.codePrevision', '=', 'prevision.idPrevision')
        ->join("postbudgetaire", "postbudgetaire.numCompte", '=', "prevision.codePostBudgetaire")
        ->where('prevision.isDelete', 0)
        ->where('realisation.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->orderBy('dateRea',"DESC")
        ->get();
        return view("realisation.index", compact("realisation"));
    }

    public function create(Request $request)
    {
        $fonction = new myFonction();

        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }

        $realisation= DB::table('realisation')
        ->leftJoin('prevision', 'realisation.codePrevision', '=', 'prevision.idPrevision')
        ->join("postbudgetaire", "postbudgetaire.numCompte", '=', "prevision.codePostBudgetaire")
        ->where('prevision.isDelete', 0)
        ->get();

        $post =  DB::table("postbudgetaire")->select('*')
                ->whereIn('numCompte',function($query) {
                $query->select('codePostbudgetaire')
                ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
         })
         ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
         ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
         ->where("exercice.codeExercice", session('codeExo'))
         ->where('postbudgetaire.isDelete', 0)
         ->orderBy("intitulePost", "ASC")
         ->get();

        $exo = exercice::where("statusExo", "Encours")
            ->where("agence", session('BranchCode'))
             ->Orwhere("statusExo", "Encloture")
            ->where("codeExercice",session('codeExo'))
            ->get();

        $employe = Employe::where('isDelete', 0)
        ->orderBy('nomEmp')
        ->get();

        $orders = DB::select ("SELECT codePrevision, SUM(montantRea) AS total FROM realisation GROUP BY (codePrevision)");
/*
                $orders = DB::table('orders')
                ->select('department', DB::raw('SUM(price) as total_sales'))
                ->groupBy('department')
                ->havingRaw('SUM(price) > ?', [2500])
                ->get();
                */

        return view("realisation.new", compact("post", "employe", 'exo'));
    }


    public function search()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }

        $realisation= DB::table('realisation')
        ->leftJoin('prevision', 'realisation.codePrevision', '=', 'prevision.idPrevision')
        ->join("postbudgetaire", "postbudgetaire.numCompte", '=', "prevision.codePostBudgetaire")
        ->where('prevision.isDelete', 0)
        ->where('realisation.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->get();
        session()->flash('printsearchList', $realisation);
        return view("realisation.search", compact("realisation"));
    }



    public function find(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $post = request('postbudgetaire');
        $debut =request('periodDebut');
        $fin = request('periodFin');
        if($post == '*')
        {
            $realisation= DB::table('realisation')
            ->leftJoin('prevision', 'realisation.codePrevision', '=', 'prevision.idPrevision')
            ->join("postbudgetaire", "postbudgetaire.numCompte", '=', "prevision.codePostBudgetaire")
            ->where('prevision.isDelete', 0)
            ->where('realisation.isDelete', 0)
            ->where('prevision.exercicePrevi', session('codeExo'))
            ->whereBetween('dateRea', [$debut, $fin])
            ->get();
            session()->put('printsearchListPost', "Tous");

        }elseif($post!='*' and !empty($post))
        {
            $realisation= DB::table('realisation')
            ->leftJoin('prevision', 'realisation.codePrevision', '=', 'prevision.idPrevision')
            ->join("postbudgetaire", "postbudgetaire.numCompte", '=', "prevision.codePostBudgetaire")
            ->where('prevision.isDelete', 0)
            ->where('realisation.isDelete', 0)
            ->where('prevision.exercicePrevi', session('codeExo'))
            ->where('postbudgetaire.numCompte', $post)
            ->whereBetween('dateRea', [$debut, $fin])
            ->get();
            session()->put('printsearchListPost', $post);
        }
        session()->put('printsearchList', $realisation);
        session()->put('printsearchListDateFin', $fin);
        session()->put('printsearchListDateDebut', $debut);
        return view("realisation.search", compact("realisation", 'debut',"fin"));
    }
    public function showDetail(Request $request)
    {
        $code =  request("slug");
        $realisation= DB::table('realisation')
        ->leftJoin('prevision', 'realisation.codePrevision', '=', 'prevision.idPrevision')
        ->join("postbudgetaire", "postbudgetaire.numCompte", '=', "prevision.codePostBudgetaire")
        ->where('prevision.isDelete', 0)
        ->where('realisation.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->where('refferenceRea', $code)
        ->get();
        //dd($realisation);
        return view("realisation.show", compact("realisation"));

    }
    public function delete(Request $request)
    {
        $code =  request("slug");
        $realisation= DB::table('realisation')
        ->leftJoin('prevision', 'realisation.codePrevision', '=', 'prevision.idPrevision')
        ->join("postbudgetaire", "postbudgetaire.numCompte", '=', "prevision.codePostBudgetaire")
        ->where('prevision.isDelete', 0)
        ->where('realisation.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->where('refferenceRea', $code)
        ->get();
        //dd($realisation);
        return view("realisation.show", compact("realisation"));

    }

    public function store(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }

        $myFonction = new myFonction();
        $codePost =request('codePost');
        $post = $myFonction->getPost($codePost);
        $reaannuelPost = $myFonction->ReaAnnuelPost($codePost, session("codeExo"));
        $PreviannuelPost =  $myFonction->PreviAnnuelPost($codePost, session("codeExo"));
        $previmens = ($PreviannuelPost /12);
        $dateDebutMois  = date('Y').'-'.date('m').'-01';
        $dateFinMois = date('Y-m-t', strtotime($dateDebutMois));
        $reaMenPost = $myFonction->MontantReaPostSurPeriodDe(session('codeExo'), $dateDebutMois, $dateFinMois, $codePost);
        $tauxMensPost  = ($reaMenPost/$previmens) * 100;
        $tauxAnnuel = ($reaannuelPost/$PreviannuelPost)* 100;
        $ecartAnnuel  = $PreviannuelPost - $reaannuelPost;
        $ecartMens = $previmens - $reaMenPost;
        $tA = $tauxAnnuel;
        $tM = $tauxMensPost;
        $Em = $ecartMens;

        $reaMensuelleHidde = $reaMenPost;
        $reaannuelPost = number_format($reaannuelPost,2, ',', ' ');
        $PreviannuelPost = number_format($PreviannuelPost,2, ',', ' ');
        $tauxAnnuel = number_format($tauxAnnuel,2, ',', ' ');
        $previmens = number_format($previmens,2, ',', ' ');
        $reaMenPost = number_format($reaMenPost,2, ',', ' ');
        $tauxMensPost = number_format($tauxMensPost,2, ',', ' ');
        $ecartAnnuel = number_format($ecartAnnuel,2, ',', ' ');
        $ecartMens =  number_format($ecartMens,2, ',', ' ');
        return array($post, $reaannuelPost, $PreviannuelPost,$tauxAnnuel, $previmens,$reaMenPost,$tauxMensPost,$ecartAnnuel,$ecartMens,$tA,$tM,$Em,$reaMensuelleHidde);
    }

    //generation du pdf de validation
    public function newValisationPDF()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
      $pdf = PDF::loadView('Realisation/pdfPreValidation');
      //return view('Realisation/pdfPreValidation');
      return $pdf->download('VourcherValidation.pdf');
    }

    public function listeImprimable()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $realisation= DB::table('realisation')
        ->leftJoin('prevision', 'realisation.codePrevision', '=', 'prevision.idPrevision')
        ->join("postbudgetaire", "postbudgetaire.numCompte", '=', "prevision.codePostBudgetaire")
        ->where('prevision.isDelete', 0)
        ->where('realisation.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->orderBy('dateRea',"DESC")
        ->get();
        $pdf = PDF::loadView("realisation.pintAllPDF", compact("realisation"))->setPaper('A4', 'landscape',"10","10","10");
      //return view('Realisation/pdfPreValidation');
        return $pdf->stream('List_des_realisation.pdf');

    }

    public function printPreValidation(Request $request)
    {
    
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $codePost =request("codePost");
        $montantSortie = request("montantSortie");
        $autoriseBy = request('autoriseBy');
        $doneBy = request('doneBy');
        $observation = request("observation");
        session()->flash('code', $codePost);
        session()->flash('autoriseBy', $autoriseBy);
        session()->flash('doneBy', $doneBy);
        session()->flash('observation', $observation);
        session()->flash('montant', $montantSortie);
        return "success";
    }

    public function PrintPreview()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $fonction = new myFonction;
        $montantSortie = session("montant");
        $codePost = session('code');
        $autoriseBy = session("autoriseBy");
        $doneBy = session("doneBy");
        $observation = session("observation");
        if(empty($montantSortie) or empty($codePost) or empty($doneBy) or empty($autoriseBy))
        {
            $myErrors = "Veuillez Renseigner tous les champs obligatoires";
            session()->flash('errorsformPrint', $myErrors);
            return redirect()->to('realisation/new');
        }
        $nbre = Realisation::where('isDelete',0)->count();
        $reff = "MVT".date("d").date('m').date('y').date('H').date('i').date('s').date('v').(++$nbre);
        $pdf = PDF::loadView("realisation.PreValidationForm", compact('codePost','observation','doneBy', 'autoriseBy', "montantSortie",'reff'))->setPaper('A4', 'landscape');
        //return view('Realisation/pdfPreValidation');
        return $pdf->stream('Prevalidationforme.pdf');
    }

    public function update(Request $request)
    {

        $action = htmlspecialchars(request('realisationUpgradeAction'));
        $reffenceMvt = htmlspecialchars(request("RefferenceSortie"));

       if($action=="delete")
       {
            $mvt = Realisation::where("refferenceRea", $reffenceMvt)->where('isDelete',0)->update(['isDelete'=> 1]);
            return redirect()->to('realisation');

       }elseif($action=="update")
       {
            $mvt = Realisation::where("refferenceRea", $reffenceMvt)->where('isDelete',0)
            ->update([
                'isDelete'=> 0,
                "montantRea" => htmlspecialchars(request("montantSortie")),
                "dateRea" => htmlspecialchars(request("dateRea")),
                "observationRea" => htmlspecialchars(request("observation")),
                "codePrevision" => htmlspecialchars(request("codePrevisionPost")),
                "autorise_par" => htmlspecialchars(request("effectuer_par")),
                "effectuer_par" => htmlspecialchars(request("autorise_par"))
            ]);
            $msg = $request->session()->flash('msgUpdateRealisation', "Modification effectuer avec succes !");
            return redirect()->back();
       }


    }

    public function insert(Request $request)
    {

        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $nbre = Realisation::where('isDelete',0)->count();
        $reff = "MVT".date("d").date('m').date('y').date('H').date('i').date('s').date('v').(++$nbre);

        $montantSortie = htmlspecialchars(request("montant"));
        $dateRea = htmlspecialchars(request("datarea"));
        $observation = htmlspecialchars(request("observationrea"));
        $employe_effectuer = htmlspecialchars(request("employe_effectuer"));
        $employe_autorise = htmlspecialchars(request("employe_autorise"));
        $fonction = new myFonction;
        //dd(request('post'));
        $post  = $fonction->getPost(htmlspecialchars(request("post")))->first();
        $prevision = $post->idPrevision;
        $realisation  = new realisation;
        $realisation->refferenceRea  = $reff;
        $realisation->montantRea  = $montantSortie;
        $realisation->dateRea = $dateRea;
        $realisation->observationRea = $observation;
        $realisation->codePrevision = $prevision;
        $realisation->isDelete = 0;
        $realisation->autorise_par = $employe_autorise;
        $realisation->effectuer_par = $employe_effectuer;
        $realisation->save();
        session()->flash('addSucceedMvt', "Operation effectuer avec succes");
        return redirect()->back();

    }

    public function printSearchpdf()
    {
        $mouvement   = session('printsearchList');
        $debut = session('printsearchListDateDebut');
        $fin = session('printsearchListDateFin');
        $lePost = session('printsearchListPost');
        $pdf = PDF::loadView("realisation/printSearch",compact('mouvement','debut','fin','lePost'))->setPaper('A4', 'landscape');
        return $pdf->stream('Prevalidationforme.pdf');
    }


    public function import()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        return view("realisation/importer");
    }
    public function importTraitement(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        while(count($data)>0)
        {
            // code || montant || exercice || Observation
            $dat  = array_shift($data);
            $ligne  = explode(';', $dat[0]);
            $nbre = Realisation::where('isDelete',0)->count();
            $reff = "MVT".date("d").date('m').date('y').date('H').date('i').date('s').date('v').(++$nbre);
            $post = $fonction->getPost($ligne[2])->first();
            $realisation  = new realisation;
            $realisation->refferenceRea  = $reff;
            $realisation->montantRea  = $ligne[3];
            $realisation->dateRea = $ligne[6];
            $realisation->observationRea = $ligne[5];
            $realisation->codePrevision = $post->idPrevision;
            $realisation->isDelete = 0;
            $realisation->autorise_par = "67JGJH";
            $realisation->effectuer_par = "67JGJH";
            $realisation->save();
        }
        session()->flash('importSuccess', "Operation effectuer avec succes");
        return redirect()->back();
    }

}



