<?php

namespace App\Http\Controllers;

use App\Models\popularbooks;
use Illuminate\Http\Request;

class HomeController extends Controller
{


public function welcome()
{
    $pop = popularbooks::all();
    return view('welcome', compact('pop'));
}
}
