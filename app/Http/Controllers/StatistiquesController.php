<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prevision;
use App\Agence;
use App\realiastion;
use App\myFonction;
use DB;
use PDF;
class StatistiquesController extends Controller
{
   public function index(Request $request)
   {

       $fonction = new myFonction();
       if($fonction->isInSession())
       {
           return  redirect()->to("login");
       }
        $montantTotalPrevionAnnuelle = session('montantTotalPrevionAnnuelle');
        $montantTotalRealisationAnnuelle=session("montantTotalRealisationAnnuelle");
        $dateDebut = date('Y').'/'.date('m').'/'.'01';
        $datefin =date('Y').'/'.date('m').'/'.date('d');

        $montantTotalRealisationMensuel= DB::table('realisation')
        ->where('realisation.isDelete', 0)
        ->leftJoin('prevision', 'Prevision.idPrevision',"=","realisation.codePrevision")
        ->where('exercicePrevi', session("codeExo"))
        ->whereBetween('dateRea',[$dateDebut, $datefin])
        ->SUM("montantRea");
        $budgetSide = session("budgetSide");

        for($i= 1; $i<=date("m"); $i++)
        {
            $dateDebut =  $dateDebut = date('Y').'-'.$i.'-'.'01';
            $dateFin = date('Y-m-t', strtotime($dateDebut));
            $realisationMois= DB::table('realisation')
            ->where('realisation.isDelete', 0)
            ->leftJoin('prevision', 'Prevision.idPrevision',"=","realisation.codePrevision")
            ->where('exercicePrevi', session("codeExo"))
            ->whereBetween('dateRea',[$dateDebut, $dateFin])
            ->SUM("montantRea");
            $tabReaAnnuel[$i-1] = $realisationMois/1000;
        }
        $post =  DB::table("postbudgetaire")->select('*')
        ->whereIn('numCompte',function($query) {
        $query->select('codePostbudgetaire')
        ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
        })
        ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
        ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
        ->where('postbudgetaire.isDelete', 0)
         ->where('prevision.exercicePrevi', session('codeExo'))
        ->orderBy("numCompte", "ASC")
        ->get();
        return view("index",compact('post','montantTotalPrevionAnnuelle','montantTotalRealisationAnnuelle','montantTotalRealisationMensuel','budgetSide','tabReaAnnuel'));
   }



   public function consoEncours()
   {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }

        $post =  DB::table("postbudgetaire")->select('*')
        ->whereIn('numCompte',function($query) {
        $query->select('codePostbudgetaire')
        ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
        })
        ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
        ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
        ->where('postbudgetaire.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->orderBy("numCompte", "ASC")
        ->get();
        return view("imprimable/ConsoEncours",compact("post"));
   }

   public function PrintconsoEncours()
   {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $post =  DB::table("postbudgetaire")->select('*')
        ->whereIn('numCompte',function($query) {
        $query->select('codePostbudgetaire')
        ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
        })
        ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
        ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
        ->where('postbudgetaire.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->orderBy("numCompte", "ASC")
        ->get();
        $pdf = PDF::loadView("imprimable/pdfConsoEncours",compact("post"))->setPaper('A4', 'landscape',"10","10","10");
        //return view('Realisation/pdfPreValidation');

        return $pdf->stream('Consolide_realisation_encours.pdf');
   }


   public function bilanDesMoisPasse()
   {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $post =  DB::table("postbudgetaire")->select('*')
        ->whereIn('numCompte',function($query) {
        $query->select('codePostbudgetaire')
        ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
        })
        ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
        ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
        ->where('postbudgetaire.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->orderBy("numCompte", "ASC")
        ->get();
        return view("imprimable/ComparaisonParMois",compact("post"));
   }

   public function bilanConsoMois()
   {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $post =  DB::table("postbudgetaire")->select('*')
        ->whereIn('numCompte',function($query) {
        $query->select('codePostbudgetaire')
        ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
        })
        ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
        ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
        ->where('postbudgetaire.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->orderBy("numCompte", "ASC")
        ->get();
      
        $pdf = PDF::loadView("imprimable/ConsoParMois",compact("post"))->setPaper('A4', 'landscape',"10","10","10");
        //return view('Realisation/pdfPreValidation');

        return $pdf->stream('ConsoEncoursmois.pdf');
   }



   public function postEnDepassementParMois(Request $request)
   {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }

        $post =  DB::table("postbudgetaire")->select('*')
        ->whereIn('numCompte',function($query) {
        $query->select('codePostbudgetaire')
        ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
        })
        ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
        ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
        ->where('postbudgetaire.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->orderBy("numCompte", "ASC")
        ->get();

        return view("imprimable/postEnDepassement",compact("post"));
   }


   public function enDepassement(Request $request)
   {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $period = request('period');
        $post =  DB::table("postbudgetaire")->select('*')
        ->whereIn('numCompte',function($query) {
        $query->select('codePostbudgetaire')
        ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
        })
        ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
        ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
        ->where('postbudgetaire.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->orderBy("numCompte", "ASC")
        ->get();
        return view("imprimable/postEnDepassement",compact("post","period"));
   }


 public function postEnDepassementPDF(Request $request)
   {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $period = request('period');
        $post =  DB::table("postbudgetaire")->select('*')
        ->whereIn('numCompte',function($query) {
        $query->select('codePostbudgetaire')
        ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
        })
        ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
        ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
        ->where('postbudgetaire.isDelete', 0)
        ->where('prevision.exercicePrevi', session('codeExo'))
        ->orderBy("numCompte", "ASC")
        ->get();
        $pdf = PDF::loadView("imprimable/pdfPostEnDepassement",compact("post","period"))->setPaper('A4', 'portrait',"10","10","10");
        //return view('Realisation/pdfPreValidation');

        return $pdf->stream('postEnDepassement.pdf');
   }

   


}
