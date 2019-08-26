<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimport;
use App\postbudgetaire;
use DB;
use App\myFonction;
use App\categorie;
use Excel;
class PostBudgetaireController extends Controller
{

    public function index()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $postbudgetaire = DB::table('postbudgetaire')
        ->leftJoin('categorie', 'postbudgetaire.categorie', '=', 'categorie.codeCat')
        ->where('postbudgetaire.isDelete', 0)
        ->get();
        return view("Postbudgetaire.index", compact("postbudgetaire"));
    }

    public function import()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        return view("Postbudgetaire.importe");
    }


    public function create()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $categorie = Categorie::where("IsDelete",0)->get();
        return view("Postbudgetaire/new", compact("categorie"));
    }

    public function store(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $post = new PostBudgetaire;
        $post->numCompte = request('numCompte');
        $post->intitulePost = request('libelle');
        $post->sensPost = request('sens');
        $post->categorie = request('categorie');
        $post->isDelete = 0;
        $post->save();
        return redirect()->back();
    }


    public function show()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $code = request("id");
        $post = PostBudgetaire::where('isDelete', 0)
        ->where('numCompte', $code)
        ->get();
        return view("Postbudgetaire.show", compact("post"));
    }


    public function edit()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $code = request("id");
        $post = PostBudgetaire::where('isDelete', 0)
        ->where('numCompte', $code)
        ->get();
        return view("Postbudgetaire.edit", compact("post"));
    }

    public function delete()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $code = request("id");
        $post = PostBudgetaire::where('isDelete', 0)
        ->where('numCompte', $code)
        ->get();
        return view("Postbudgetaire.delete", compact("post"));
    }

    public function export()
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
            $data = PostBudgetaire::where("isDelete" ,0)
            ->get()
            ->toArray();
            return view("Postbudgetaire.export", compact("data"));
    }

    public function import_process(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        while(count($data)>0)
        {
            // code || montant || exercice || Observation
            $dat  = array_shift($data);
            $ligne  = explode(';', $dat[0]);
            $post = new PostBudgetaire;
            $post->numCompte =$ligne[1];
            $post->intitulePost = $ligne[2];
            $post->sensPost = "Charge";
            $post->categorie = 1;
            $post->isDelete = 0;
            $post->save();
        }
        session()->flash('importSuccess', "Operation effectuer avec succes");
        return redirect()->back();
    }
}
