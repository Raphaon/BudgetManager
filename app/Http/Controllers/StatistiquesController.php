<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prevision;
use App\Agence;
use App\realiastion;
use App\myFonction;
use Carbon\Carbon;
use DB;
use PDF;

class StatistiquesController extends Controller
{
    public function index(Request $request)
    {

        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }
        Carbon::setLocale('fr');

        $montantTotalPrevionAnnuelle = (float) session('montantTotalPrevionAnnuelle', 0);
        $montantTotalRealisationAnnuelle = (float) session('montantTotalRealisationAnnuelle', 0);

        $dateDebut = Carbon::now()->startOfMonth()->format('Y-m-d');
        $datefin = Carbon::now()->endOfDay()->format('Y-m-d');

        $montantTotalRealisationMensuel = DB::table('realisation')
            ->where('realisation.isDelete', 0)
            ->leftJoin('prevision', 'Prevision.idPrevision', '=', 'realisation.codePrevision')
            ->where('exercicePrevi', session('codeExo'))
            ->whereBetween('dateRea', [$dateDebut, $datefin])
            ->sum('montantRea');

        $budgetSide = session('budgetSide');

        $monthlyLabels = [];
        $monthlyRealisation = [];
        $monthlyTarget = $montantTotalPrevionAnnuelle > 0 ? $montantTotalPrevionAnnuelle / 12 : 0;

        for ($i = 1; $i <= 12; $i++) {
            $monthStart = Carbon::create((int) date('Y'), $i, 1)->startOfMonth();
            $monthEnd = (clone $monthStart)->endOfMonth();

            $realisationMois = DB::table('realisation')
                ->where('realisation.isDelete', 0)
                ->leftJoin('prevision', 'Prevision.idPrevision', '=', 'realisation.codePrevision')
                ->where('exercicePrevi', session('codeExo'))
                ->whereBetween('dateRea', [$monthStart->format('Y-m-d'), $monthEnd->format('Y-m-d')])
                ->sum('montantRea');

            $monthlyLabels[] = ucfirst($monthStart->translatedFormat('F'));
            $monthlyRealisation[] = (float) $realisationMois;
        }
        $post =  DB::table("postbudgetaire")->select('*')
            ->whereIn('numCompte', function ($query) {
                $query->select('codePostbudgetaire')
                    ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
            })
            ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
            ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
            ->where('postbudgetaire.isDelete', 0)
            ->where('prevision.exercicePrevi', session('codeExo'))
            ->orderBy("numCompte", "ASC")
            ->get();
        $annualGap = $montantTotalPrevionAnnuelle - $montantTotalRealisationAnnuelle;
        $monthlyGap = $monthlyTarget - $montantTotalRealisationMensuel;

        $annualProgress = $montantTotalPrevionAnnuelle > 0
            ? max(0, min(100, ($montantTotalRealisationAnnuelle / $montantTotalPrevionAnnuelle) * 100))
            : 0;

        $monthlyProgress = $monthlyTarget > 0
            ? max(0, min(100, ($montantTotalRealisationMensuel / $monthlyTarget) * 100))
            : 0;

        $postCollection = collect($post);

        $postsWithStats = $postCollection->map(function ($item) use ($fonction) {
            $previsionAnnuelle = (float) $fonction->PreviAnnuelPost($item->numCompte, session('codeExo'));
            $realisationAnnuelle = (float) $fonction->ReaAnnuelPost($item->numCompte, session('codeExo'));

            $debutPeriod = Carbon::now()->startOfMonth()->format('Y-m-d');
            $finPeriode = Carbon::now()->endOfMonth()->format('Y-m-d');

            $realisationMensuelle = (float) $fonction->MontantReaPostSurPeriodDe(
                session('codeExo'),
                $debutPeriod,
                $finPeriode,
                $item->numCompte
            );

            $previsionMensuelle = $previsionAnnuelle > 0 ? $previsionAnnuelle / 12 : 0;

            $annualRatio = $previsionAnnuelle > 0 ? ($realisationAnnuelle / $previsionAnnuelle) * 100 : 0;
            $monthlyRatio = $previsionMensuelle > 0 ? ($realisationMensuelle / $previsionMensuelle) * 100 : 0;

            return [
                'code' => $item->numCompte,
                'label' => $item->intitulePost,
                'prevision_annuelle' => $previsionAnnuelle,
                'realisation_annuelle' => $realisationAnnuelle,
                'prevision_mensuelle' => $previsionMensuelle,
                'realisation_mensuelle' => $realisationMensuelle,
                'annual_ratio' => $annualRatio,
                'monthly_ratio' => $monthlyRatio,
            ];
        });

        $topPosts = $postsWithStats->sortByDesc('annual_ratio')->take(5)->values();

        $alertPosts = $postsWithStats
            ->filter(function ($stats) {
                return $stats['monthly_ratio'] >= 100 || $stats['annual_ratio'] >= 100;
            })
            ->sortByDesc('annual_ratio')
            ->values();

        return view('index', compact(
            'post',
            'montantTotalPrevionAnnuelle',
            'montantTotalRealisationAnnuelle',
            'montantTotalRealisationMensuel',
            'budgetSide',
            'monthlyLabels',
            'monthlyRealisation',
            'monthlyTarget',
            'annualGap',
            'monthlyGap',
            'annualProgress',
            'monthlyProgress',
            'topPosts',
            'alertPosts'
        ));
    }



    public function consoEncours()
    {
        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }

        $post =  DB::table("postbudgetaire")->select('*')
            ->whereIn('numCompte', function ($query) {
                $query->select('codePostbudgetaire')
                    ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
            })
            ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
            ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
            ->where('postbudgetaire.isDelete', 0)
            ->where('prevision.exercicePrevi', session('codeExo'))
            ->orderBy("numCompte", "ASC")
            ->get();
        return view("imprimable/ConsoEncours", compact("post"));
    }

    public function PrintconsoEncours()
    {
        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }
        $post =  DB::table("postbudgetaire")->select('*')
            ->whereIn('numCompte', function ($query) {
                $query->select('codePostbudgetaire')
                    ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
            })
            ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
            ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
            ->where('postbudgetaire.isDelete', 0)
            ->where('prevision.exercicePrevi', session('codeExo'))
            ->orderBy("numCompte", "ASC")
            ->get();
        $pdf = PDF::loadView("imprimable/pdfConsoEncours", compact("post"))->setPaper('A4', 'landscape', "10", "10", "10");
        //return view('Realisation/pdfPreValidation');

        return $pdf->stream('Consolide_realisation_encours.pdf');
    }


    public function bilanDesMoisPasse()
    {
        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }
        $post =  DB::table("postbudgetaire")->select('*')
            ->whereIn('numCompte', function ($query) {
                $query->select('codePostbudgetaire')
                    ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
            })
            ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
            ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
            ->where('postbudgetaire.isDelete', 0)
            ->where('prevision.exercicePrevi', session('codeExo'))
            ->orderBy("numCompte", "ASC")
            ->get();
        return view("imprimable/ComparaisonParMois", compact("post"));
    }

    public function bilanConsoMois()
    {
        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }
        $post =  DB::table("postbudgetaire")->select('*')
            ->whereIn('numCompte', function ($query) {
                $query->select('codePostbudgetaire')
                    ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
            })
            ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
            ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
            ->where('postbudgetaire.isDelete', 0)
            ->where('prevision.exercicePrevi', session('codeExo'))
            ->orderBy("numCompte", "ASC")
            ->get();

        $pdf = PDF::loadView("imprimable/ConsoParMois", compact("post"))->setPaper('A4', 'landscape', "10", "10", "10");
        //return view('Realisation/pdfPreValidation');

        return $pdf->stream('ConsoEncoursmois.pdf');
    }



    public function postEnDepassementParMois(Request $request)
    {
        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }

        $post =  DB::table("postbudgetaire")->select('*')
            ->whereIn('numCompte', function ($query) {
                $query->select('codePostbudgetaire')
                    ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
            })
            ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
            ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
            ->where('postbudgetaire.isDelete', 0)
            ->where('prevision.exercicePrevi', session('codeExo'))
            ->orderBy("numCompte", "ASC")
            ->get();

        return view("imprimable/postEnDepassement", compact("post"));
    }


    public function enDepassement(Request $request)
    {
        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }
        $period = request('period');
        $post =  DB::table("postbudgetaire")->select('*')
            ->whereIn('numCompte', function ($query) {
                $query->select('codePostbudgetaire')
                    ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
            })
            ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
            ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
            ->where('postbudgetaire.isDelete', 0)
            ->where('prevision.exercicePrevi', session('codeExo'))
            ->orderBy("numCompte", "ASC")
            ->get();
        return view("imprimable/postEnDepassement", compact("post", "period"));
    }


    public function postEnDepassementPDF(Request $request)
    {
        $fonction = new myFonction();
        if ($fonction->isInSession()) {
            return  redirect()->to("login");
        }
        $period = request('period');
        $post =  DB::table("postbudgetaire")->select('*')
            ->whereIn('numCompte', function ($query) {
                $query->select('codePostbudgetaire')
                    ->from('prevision')->where('prevision.exercicePrevi', session("codeExo"));
            })
            ->join("prevision", "prevision.codePostBudgetaire", '=', "postbudgetaire.numCompte")
            ->join("exercice", "exercice.codeExercice", '=', "prevision.exercicePrevi")
            ->where('postbudgetaire.isDelete', 0)
            ->where('prevision.exercicePrevi', session('codeExo'))
            ->orderBy("numCompte", "ASC")
            ->get();
        $pdf = PDF::loadView("imprimable/pdfPostEnDepassement", compact("post", "period"))->setPaper('A4', 'portrait', "10", "10", "10");
        //return view('Realisation/pdfPreValidation');

        return $pdf->stream('postEnDepassement.pdf');
    }
}
