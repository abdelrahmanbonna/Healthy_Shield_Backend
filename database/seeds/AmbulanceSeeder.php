<?php

use Illuminate\Database\Seeder;

class AmbulanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ambulances=[];
        foreach ($ambulances as $a){
            Doctor::firstOrCreate($ambulance);
        }
    }
}
