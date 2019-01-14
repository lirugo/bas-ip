<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee\Employee;

class EmployeeController extends Controller
{
    public function index(){
        return Employee::with('name', 'department', 'staffPositions')->get();
    }
}
