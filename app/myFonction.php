<?php

namespace App;
use App\PostBudgetaire;
use App\Prevision;
use App\Realisation;
use DB;
use App\Agence;
use App\Models\Employe;
class myFonction
{
    //fonction qui  donne le reliquat prevission d'un post budgetaire
    public function PreviAnnuelPost($numComptes ,$codeExo)
    {
        return DB::table('prevision')
        ->where('isDelete', 0)
        ->where('exercicePrevi', $codeExo)
        ->where('codePostBudgetaire', $numComptes)
        ->SUM("montantPrevision");
    }

     //fonction qui  donne le reliquat prevission d'un post budgetaire
     public function ReaAnnuelPost($numComptes ,$codeExo)
     {
        return  DB::table('realisation')
        ->where('realisation.isDelete', 0)
        ->leftJoin('prevision', 'Prevision.idPrevision',"=","realisation.codePrevision")
        ->where('prevision.codePostBudgetaire', $numComptes)
        ->where('exercicePrevi', $codeExo)
        ->SUM("montantRea");

     }
    //fonction qui  donne le reliquat prevission d'un post budgetaire
    public function TotalPreviAnnuel($codeExo)
    {
        return DB::table('prevision')
        ->where('isDelete', 0)
        ->where('exercicePrevi', $codeExo)
        ->SUM("montantPrevision");
    }


    //fonction qui  donne le reliquat prevission d'un post budgetaire
    public function TotalReaAnnuel($codeExo)
    {
        return  DB::table('realisation')
        ->where('realisation.isDelete', 0)
        ->leftJoin('prevision', 'Prevision.idPrevision',"=","realisation.codePrevision")
        ->where('exercicePrevi',$codeExo)
        ->SUM("montantRea");

    }

    //cette fonction permet de  rediriger l'utilisateur vers le login si il ne sait pas connecte

    public function isInSession()
    {

        if ( !(session()->has('user')) or !(session()->has('budgetSide')) or !(session()->has('userGroupCode')) or !(session()->has('userId')) ) {
           return true;
        }
        else
        {
         return false;

        }
    }

     //fonction qui  donne le total des realisation sur une periode de temps concernant un post
     public function MontantReaPostSurPeriodDe($codeExo, $debutPeriod, $finPeriode, $numComptes)
     {
        return  DB::table('realisation')
        ->where('realisation.isDelete', 0)
        ->leftJoin('prevision', 'Prevision.idPrevision',"=","realisation.codePrevision")
        ->where('prevision.codePostBudgetaire', $numComptes)
        ->where('exercicePrevi', $codeExo)
        ->whereBetween('dateRea', [$debutPeriod, $finPeriode])
        ->SUM("montantRea");
     }
      //fonction qui  donne le total des realisation sur une periode de temps concernant un post
      public function MontantReaGlobalSurPeriodDe($codeExo, $debutPeriod, $finPeriode)
      {
        return  DB::table('realisation')
        ->where('realisation.isDelete', 0)
        ->leftJoin('prevision', 'Prevision.idPrevision',"=","realisation.codePrevision")
        ->where('exercicePrevi', $codeExo)
        ->whereBetween('dateRea', [$debutPeriod, $finPeriode])
        ->SUM("montantRea");
      }

      public function listPostAyantPrevi()
      {
        return   $post =  DB::table("postbudgetaire")->select('*')
        ->whereIn('numCompte',function($query) {
        $query->select('codePostbudgetaire')
        ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
        })
        ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
        ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
        ->where('postbudgetaire.isDelete', 0)
         ->where('prevision.exercicePrevi', session('codeExo'))
        ->orderBy("intitulePost", "ASC")
        ->get();
      }
      // prend en parametre le code d'une agence et retourne les info sur l'agence en question

      function getBranch($BranchCode)
      {
        return Agence::where("isDelete",0)
        ->where('codeAg', $BranchCode )
        ->first();
      }
      // permet de retourne le postbudgetaire donc le code est passe en parametre

      function getPost($numCompte)
      {
        return DB::table("postbudgetaire")->select('*')
        ->whereIn('numCompte',function($query) {
        $query->select('codePostbudgetaire')
        ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
        })
        ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
        ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
        ->where('postbudgetaire.isDelete', 0)
        ->where('postbudgetaire.numCompte', $numCompte)
        ->where('codeExercice', session('codeExo'))
        ->orderBy("intitulePost", "ASC")
        ->get();
      }

      function getEmployee($mat)
      {
        
          return DB::table("employe")->select('*')->where('isDelete', 0)->where('matriculeEmp', $mat)->first();
      }

      function listEmploye()
      {
        return Employe::where('isDelete', 0)
        ->get();
      }


 // Obtenir le solde d'un compte 

      public function getAccountBalance(Compte $compte1)
      {
        $debit = DB::table('ligne_mvt_compte')
        ->where('ligne_mvt_compte.isDelete', 0)
        ->leftJoin('compte', 'compte.numCompte', '=', 'ligne_mvt_compte.reffCompte')
        ->where('numCompte', $compte1->numCompte)
        ->where('sens', 'Debit')
        ->SUM('montant_mvt');
        $credit = $debit = DB::table('ligne_mvt_compte')
        ->where('ligne_mvt_compte.isDelete', 0)
        ->leftJoin('compte', 'compte.numCompte', '=', 'ligne_mvt_compte.reffCompte')
        ->where('numCompte', $compte1->numCompte)
        ->where('sens', 'credit')
        ->SUM('montant_mvt');
        return ($credit-$credit);
      }

}
