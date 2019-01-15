<?php

namespace App\Http\Controllers;

use App\Models\Employee\Employee;

class MainController extends Controller
{
    public function index(){
        return view('index');
    }
}
