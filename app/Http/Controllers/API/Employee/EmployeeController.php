<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee\Employee;

class EmployeeController extends Controller
{
    public function index(){
        return new EmployeeCollection(Employee::paginate());
    }

    public function show(Employee $employee){
        return new EmployeeResource($employee);
    }
}
