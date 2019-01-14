<?php

use App\Models\Hierarchy\Department;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('departments') as $key => $position)
            Department::create([
                'name' => $position,
                'slug' => $key,
            ]);
    }
}
