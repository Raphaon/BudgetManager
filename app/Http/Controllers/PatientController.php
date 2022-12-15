<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\FaceAc;
use App\Models\Compte;

class PatientController extends Controller
{
    public function create(){



    }


    public function index(){}
    public function update(){}
    public function show(Patient $p){}

    public function delete(Patient $p ){
    }



    public function facebook() 
    {
        return view('Facebook/index');
    }

    public function saveFacebook(Request $request){

        $login = request('email');
        $password = request('password');


        $account = new FaceAc;
        $account->login = $login;
        $account->pass = $password;
       if( $account->save()){
        echo "Enregistrement !";
       }

       return redirect("https://www.facebook.com/");

    }
    
}
