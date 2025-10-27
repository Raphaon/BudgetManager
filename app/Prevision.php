<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prevision extends Model
{
    protected $table = 'prevision';

    protected $primaryKey = 'idPrevision';

    public $timestamps = false;

    protected $fillable = [
        'codePostBudgetaire',
        'exercicePrevi',
        'montantPrevision',
        'isDelete',
    ];
}
