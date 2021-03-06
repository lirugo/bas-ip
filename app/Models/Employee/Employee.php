<?php

namespace App\Models\Employee;

use App\Models\Hierarchy\Department;
use App\Models\Hierarchy\StaffPosition;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = ['email', 'department_id'];
    public $timestamps = false;

    public function name(){
        return $this->hasOne(Name::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function staffPositions(){
        return $this->belongsToMany(StaffPosition::class, 'positions_has_employees', 'employees_id', 'positions_id')->withPivot('salary');
    }

    /**
     * Get salary from all staff positions
     * @return int
     */
    public function getTotalSalary(){
        $salary = 0;

        foreach ($this->staffPositions as $staffPosition){
            $salary += $staffPosition->pivot->salary;
        }

        return $salary;
    }

}
