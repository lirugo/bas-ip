<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee\Employee;
use App\Models\Employee\Name;
use App\Models\Hierarchy\Department;
use App\Models\Hierarchy\StaffPosition;
use Illuminate\Http\Request;
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

    public function store(Request $request){
        //Validate

        //Persist
        $employee = Employee::create([
            'department_id' => $request->department,
            'email' => $request->email
        ]);
        //Name
        $employee->name()->save(new Name([
            'first' => $request->firstName,
            'middle' => $request->middleName,
            'last' => $request->lastName,
        ]));
        //StaffPosition
        for($i = 0; $i < count($request->staffPositions); $i++)
            $employee->staffPositions()->attach([$request->staffPositions[$i] => ['salary' => $request->salary]]);

        //Return
        return response()->json(new EmployeeResource($employee), 201);
    }


    //TODO:: Move it
    public function departments(){
        return Department::get();
    }

    public function staffPositions(){
        return StaffPosition::get();
    }
}
