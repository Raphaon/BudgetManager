<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use PDF;

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::where('users.isDelete', '=', 0)
            ->join("groupe", "users.groupe_id", '=', "groupe.id_groupe")
            ->join('employe', "employe.matriculeEmp", '=', 'users.employeeID')
            ->join('services', "services.service_id", '=', 'employe.serviceID')
            ->join("fonction", "fonction.codeFon", '=', 'employe.fonctionID')
            ->join("agence", "agence.codeAg", '=', 'employe.branchID')
            ->get();
        return view("Users/index", compact('users'));
    }


    public function usersmanager(){
        
        $users = Users::where('users.isDelete', '=', 0)
        ->join("groupe", "users.groupe_id", '=', "groupe.id_groupe")
        ->get();
        return view('./Users/usermanager', compact('users'));

    }


    public function new(){
        
        $users = Users::where('users.isDelete', '=', 0)
        ->join("groupe", "users.groupe_id", '=', "groupe.id_groupe")
        ->get();
        return view('./Users/usermanager', compact('users'));

    }



    public function create(Request $request){

        $checkExist = Users::where('users.isDelete', "=",0)
                    ->where("users.login", '=', request('login'))
                    ->first();
        $msg  = "Echec D'enregistrment ! \n l'utilisateur existe déjà ou le mot de passe ne correspond pas ! ";
        if( ($checkExist) && (request('password') == request('cpassword'))){
            $user = new Users;
            $user->user_id = "U".date('Ymdhsi');
            $user->login = request('login');
            $user->userspass =sha1(request('password'));
            $user->users_name = request('fullName');
            $user->users_surname = "unknow";
            $user->groupe_id = 2;
            $user->question = request('question');
            $user->reponse = request('reponse');
            if($user->save()){

                $msg = "Opération reussi ! ";
            }
        }
        return redirect()->back();
        

    }







    public function show(Request $request){
        
        $users = Users::where('users.isDelete', '=', 0)
        ->join("groupe", "users.groupe_id", '=', "groupe.id_groupe")
        ->get();
        return view('./Users/usermanager', compact('users'));

    }


    public function update(Request $request){
        
        $users = Users::where('users.isDelete', '=', 0)
        ->join("groupe", "users.groupe_id", '=', "groupe.id_groupe")
        ->get();
        return view('./Users/usermanager', compact('users'));

    }

    public function delete(Request $request){
        
        $users = Users::where('users.isDelete', '=', 0)
        ->join("groupe", "users.groupe_id", '=', "groupe.id_groupe")
        ->get();
        return view('./Users/usermanager', compact('users'));

    }
































    public function login()
    {
    }

    public function loginTraitment(Request $request)
    {
        $login = request("login");
        $pass = request("passe");
        $pass = sha1($pass);
        $agence = request("agence");
        $userinfo = Users::where('isDelete', '=', 0)
            ->join('groupe', 'groupe.id_groupe', '=', 'users.groupe_id')
            ->join('employe', "employe.matriculeEmp", '=', 'users.employeeID')
            ->join('service', "service.service_id", '=', 'employe.serviceID')
            ->join("fonction", "fonction.codeFon", '=', 'employe.fonctionID')
            ->join("agence", "agence.codeAg", '=', 'employe.branchID')
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




    public function pdfHeader()
    {
        //$pdf = PDF::loadView("layouts.pdftemplate");
        //return $pdf->stream('List_des_realisation.pdf');
        return view("layouts.pdftemplate");
    }
}
