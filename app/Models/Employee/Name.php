<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    protected $table = 'employees_name';
    protected $fillable = ['first', 'middle', 'last'];
    public $timestamps = false;
}
