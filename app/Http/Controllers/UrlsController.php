<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlsController extends Controller
{
    //
    public function showIndex()
    {
        return view('tables-data');
    }
}
