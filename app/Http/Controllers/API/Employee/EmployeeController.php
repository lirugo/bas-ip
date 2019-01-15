<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee\Employee;
use Illuminate\Support\Facades\Input;

class EmployeeController extends Controller
{
    public function index(){
        //Get sort params
        $pageSize = Input::get('rowsPerPage');
        $sortBy = is_null(Input::get('sortBy')) ? 'id' : Input::get('sortBy');
        $descending = Input::get('descending') == 'true' ? 'DESC' : 'ASC';

        $employees = Employee::with('staffPositions')
                        ->join('employees_name', 'employees.id', '=', 'employees_name.employee_id')
                        ->join('departments', 'employees.department_id', '=', 'departments.id')
                        ->select(
                            'employees.*',
                            'employees_name.first as first_name',
                            'departments.name as dep'
                        )
                        ->orderBy($sortBy, $descending)
                        ->paginate($pageSize);

        return new EmployeeCollection($employees);
    }

    public function show(Employee $employee){
        return new EmployeeResource($employee);
    }
}
