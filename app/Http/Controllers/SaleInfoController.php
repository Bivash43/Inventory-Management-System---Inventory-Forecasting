<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleInfoController extends Controller
{
    public function index()
    {
        return view('backend.statistics.index');
    }
}
