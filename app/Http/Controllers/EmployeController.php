<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::where("isDelete", 0)->get();
        return view("employe/index", compact('employes'));
    }
    public function create()
    {
        return view();
    }

    public function store()
    {

    }
    public function update(){

    } 

    public function detele(){
        
    }

}
