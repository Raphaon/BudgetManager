<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use PDF;
class UsersController extends Controller
{
    public function index()
    {
        $users = Users::where('isDelete','=', 0)
        ->join("groupe", "users.groupe_id", '=', "groupe.id_groupe")
        ->get();
        return view("Users/index", compact('users') );
    }

    public function pdfHeader()
    {
        //$pdf = PDF::loadView("layouts.pdftemplate");
          //return $pdf->stream('List_des_realisation.pdf');
        return view("layouts.pdftemplate" );
    }

}
