<?php

use App\Models\Employee\Employee;
use App\Models\Employee\Name;
use App\Models\Hierarchy\StaffPosition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Employee
        factory(Employee::class, 50000)->create()->each(function ($employee) {
            //Generate name
            $employee->name()->save(factory(Name::class)->create([
                'employee_id' => $employee,
            ]));
        });

        //Add staff position for each employee
        for($i = 1; $i <= Employee::count(); $i++)
            DB::table('positions_has_employees')->insert([
                'employees_id' => $i,
                'positions_id' => rand(1, count(config('staffPositions'))),
                'salary' => mt_rand(ceil(1000/100) , floor(20000/100))*100,
            ]);

        //Add salaries for each department each staff position
        for($i = 1; $i<= StaffPosition::count(); $i++)
            DB::table('positions_has_departments')->insert([
                'positions_id' => $i,
                'department_id' => rand(1, count(config('departments'))),
            ]);

    }
}
