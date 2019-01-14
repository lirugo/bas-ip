<?php

use App\Models\Employee\Employee;
use App\Models\Hierarchy\Department;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'department_id' => rand(1, Department::count()),
        'email' => strtolower($faker->firstName.'.'.$faker->lastName.'.'.$faker->lastName.'@'.$faker->domainName),
    ];
});
