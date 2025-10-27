<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisation extends Model
{
    protected $table = 'realisation';

    protected $primaryKey = 'refferenceRea';

    public $timestamps = false;

    protected $fillable = [
        'montantRea',
        'dateRea',
        'observationRea',
        'codePrevision',
        'isDelete',
        'autorise_par',
        'effectuer_par',
    ];
}
