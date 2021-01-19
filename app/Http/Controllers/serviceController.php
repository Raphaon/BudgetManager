<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class serviceController extends Controller
{
    public function getServices(){
        return Service::get();
    }

    public function getTurningOver(){
        return 0;
    }
}
