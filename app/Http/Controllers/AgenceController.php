<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Agence;
use DB;
use Excel;
use App\myFonction;
class AgenceController extends Controller
{

    public function index()
    {
        $fonction = new myFonction();
   
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $agence = Agence::where('isDelete','=', 0)->get();
        return view('agence.index', compact('agence'));
    }


    public function store(Request $request)
    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $agenc = new agence;
        $agenc->codeAg   = request('codeAg');
        $agenc->nomAg    = request('nomAg');
        $agenc->RegionAg = request('regionAg');
        $agenc->typeAg   = request('typeAg');
        $agenc->isDelete = 0;
        $agenc->save();
        return "success";
    }

    public function update(Request $request)
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
        $agenc=agence::where("codeAg", $code)->get();
        DB::table('agence')
            ->where('codeAg', $code)
            ->update([
            'nomAg'=>request('nomAg'),
            'regionAg'=>request('regionAg'),
            'typeAg'=>request('nomAg')
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

    public function exportdata()

    {
        $fonction = new myFonction();
        if($fonction->isInSession())
        {
            return  redirect()->to("login");
        }
        $agenc = Agence::where("isDelete",  0);
        return Excel::create('data_agence', function($excel) use ($agenc)
        {
            $excel->sheet('mysheet',function($sheet) use ($agenc) {
                $sheet->fromArray($agenc);
            });
        } )->download("xsl");
    }
}
