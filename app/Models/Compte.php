<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
     protected $table ='compte';
    public $timestamps = 0;

    public function getBalance(){

    }
    public function credit($amount, $accountDebit){

    }


    public function debit($amount, $accountCredit){

    }

    public function approv($amout){

    }


    public function withdraw($amount){

    }

    public function getHistory()
    {
      
    }

    
}
