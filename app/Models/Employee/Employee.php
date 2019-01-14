<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    public $timestamps = false;

    public function name(){
        return $this->hasOne(Name::class);
    }
}
