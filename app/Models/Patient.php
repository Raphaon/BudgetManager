<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;

class Patient extends Users
{
    protected $table ="patient";
    protected $matricule;
    protected $name; 
    protected $dateNaiss; 
    protected $profession ;
    protected $telephone;
    protected $email ;
    protected $domicile;
    protected $gender ;
    protected $hobies; 
    
    

}
