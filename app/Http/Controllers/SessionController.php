<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agence;
use App\Models\Users;
use App\groupe_avoir_permission;
use App\Exercice;
use App\Prevision;
use DB;
use Illuminate\Http\RedirectResponse;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $erreurs = request("erreurs");
        $agence = Agence::where('isDelete', '=', 0)->get();
        $agences = Agence::where('isDelete', '=', 0)->get();
        //dd($agences);
        return view("session.index", compact('erreurs', 'agences', 'agence'));
    }

    public function loginCheck(Request $request)
    {
        $login = request("login");
        $pass = request("passe");
        $pass = sha1($pass);
        $agence = request("agence");


        $userinfo = Users::where('isDelete', '=', 0)
            ->join('groupe', 'groupe.id_groupe', '=', 'users.groupe_id')
            ->where('login', $login)
            ->where('userspass', $pass)
            ->get();
        $isLoginExist = $userinfo->count();
        if ($isLoginExist) {
            foreach ($userinfo as $user) {
                $groupe_id = $user->groupe_id;
                $user_id = $user->user_id;
            }
            return redirect()->route('session_load', compact('user_id', 'groupe_id', 'login', 'agence', 'pass'));
        }
        $erreurs = "identifiants";
        return redirect()->route('login', compact("erreurs"));
    }

    public function loadSession(Request $request)
    {
        $groupe = request("groupe_id");
        $permission = Groupe_avoir_permission::where('groupe.id_groupe', $groupe)
            ->leftJoin('groupe', 'groupe.id_groupe', '=', 'groupe_avoir_permission.groupe_id')
            ->rightJoin('permission', 'permission.id_permission', '=', 'groupe_avoir_permission.permission_id')
            ->join('element', 'permission.element_id', '=', 'element.id_element')
            ->get();

        if ($permission->count() > 0) {
            $agence = request('agence');
            $login = request('login');
            $codeGroupe = request('groupe_id');
            $userId = request('user_id');
            foreach ($permission as $per) {
                if ($per->nom = "Charges" and $per->libelle = "All") {
                    $request->session()->regenerate();
                    $request->session()->put('budgetSide', 'Charges');
                    $request->session()->put('BranchCode', $agence);
                    $request->session()->put('user', $login);
                    $request->session()->put('userGroupCode', $codeGroupe);
                    $request->session()->put('userId', $userId);
                    $exo = Exercice::where('isClose', 0)
                        ->where('statusExo', '=', 'Encours')
                        ->where('agence', '=', $agence)
                        ->get();
                    if ($exo->count() > 0) {
                        $exo = $exo->first();
                        $request->session()->put('codeExo', $exo->codeExercice);
                        $request->session()->put('anneeExo', $exo->AnneeExercice);
                        $request->session()->put('dateDebutExo', $exo->dateDebut);
                        $request->session()->put('dateFin', $exo->dateFin);
                    } else {
                        $request->session()->put('codeExo', "none");
                    }
                }
            }
        }

        $montantTotalPrevionAnnuelle =
            DB::table('prevision')
            ->join('postbudgetaire', 'postbudgetaire.numCompte', '=', 'prevision.codePostBudgetaire')
            ->where('prevision.isDelete', 0)
            ->where('sensPost', 'Charge')
            ->where('exercicePrevi', session("codeExo"))
            ->SUM("montantPrevision");

        $montantTotalRealisationAnnuelle = DB::table('realisation')
            ->where('realisation.isDelete', 0)
            ->leftJoin('prevision', 'Prevision.idPrevision', "=", "realisation.codePrevision")
            ->where('exercicePrevi', session("codeExo"))
            ->SUM("montantRea");
        $request->session()->put('montantTotalPrevionAnnuelle', $montantTotalPrevionAnnuelle);
        $request->session()->put('montantTotalRealisationAnnuelle', $montantTotalRealisationAnnuelle);
        return redirect()->route('home');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->to('login');
    }
}
