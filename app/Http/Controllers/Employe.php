<?php

namespace App\Http\Controllers;
use App\Models\Employe;
use Illuminate\Http\Request;

class Employe extends Controller
{
    public function index()
    {
      return view('Employe/index');
    }
}
