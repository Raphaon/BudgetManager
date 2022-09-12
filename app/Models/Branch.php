<?php

namespace App\Models;

use App\Exercice;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'agence';
    protected $branchCode;
    protected $branchName;
    protected $areaName;
    protected $typeOfBranch;
    protected $isDelete;
    protected $compagnyID;
    protected $logo;
    protected $slogand;


    public function isExist()
    {
        $numberOfBranch = Branch::where("codeAg", $this->branchCode)->count();
        if ($numberOfBranch > 0) {
            return true;
        }
        return false;
    }
    public function getExercices()
    {
        if ($this->codeBranch != null)
            return Exercice::where('agence', $this->codeBranch)->get();
        return [];
    }

    public function getExerciceEncours()
    {
        if ($this->codeBranch != null)
            return Exercice::where('agence', $this->codeBranch)->where('statusExo', 'Encours')->get();
        return [];
    }


    public function getEmployees()
    {
        if ($this->codeBranch != null)
            return Employe::where('branch', $this->codeBranch)->where('isDelete', 0)->get();
        return [];
    }

    public function getAnnualPrevision()
    {
    }

    public function getMonthRealisation($month)
    {
    }
}
