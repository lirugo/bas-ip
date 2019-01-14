<?php

namespace App\Models\Employee;

use App\Models\Hierarchy\Department;
use App\Models\Hierarchy\StaffPosition;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    public $timestamps = false;

    public function name(){
        return $this->hasOne(Name::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function staffPositions(){
        return $this->belongsToMany(StaffPosition::class, 'positions_has_departments', 'staff_positions_id', 'employees_id');
    }
}
