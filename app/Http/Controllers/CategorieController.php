<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Categorie;
use DB;
use App\myFonction;
class CategorieController extends Controller
{
    public function index()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $categorie = Categorie::where('isDelete','=', 0)->get();
        return view('categorie.index', compact('categorie'));
    }


    public function store(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $categorie = new categorie;
        $categorie->intituleCat = request('intituleCat');
        $categorie->isDelete = 0;
        $categorie->save();
        return "success !";
    }

    public function update(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        set_time_limit(300);
        $code = request("codeCat");
        $intitulecat = request("intituleCat");
        DB::table('categorie')
            ->where('codeCat', request("codeCat"))
            ->update([
            'intituleCat'=> request("intituleCat")
            ]);
        return  response()->json("reussi !!");
    }

    public function delete(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        set_time_limit(300);
        $code = request("codeAg");
        $nom = request("nomAg");
        $region = request("regionAg");
        $typeAg = request('typeAg');
        DB::table('agence')
            ->where('codeAg', $code)
            ->where('nomAg', $nom)
            ->where('regionAg', $region)
            ->where('typeAg', $typeAg)
            ->update([
            'isDelete'=>1,
            ]);
        return  response()->json("reussi !!");
    }
}
