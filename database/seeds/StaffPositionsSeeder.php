<?php

use App\Models\Hierarchy\StaffPosition;
use Illuminate\Database\Seeder;

class StaffPositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('staffPositions') as $key => $position)
            StaffPosition::create([
                'name' => $position,
                'slug' => $key,
            ]);
    }
}
