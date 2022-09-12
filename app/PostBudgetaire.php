<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostBudgetaire extends Model
{
    protected $table = 'postbudgetaire';
    public $timestamps = 0;

    public function isExist()
    {

        if (PostBudgetaire::where('numCompte', $this->numCompte)->where('isDelete', 0)->count() > 0)
            return true;
        return false;
    }
}
