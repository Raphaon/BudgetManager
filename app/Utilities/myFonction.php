<?php

namespace App\Utilities;
use App\PostBudgetaire;
use App\Prevision;
use App\Realisation;
use DB;
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




}
