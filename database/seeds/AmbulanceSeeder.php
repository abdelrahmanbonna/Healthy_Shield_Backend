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
        $ambulances=[
            [
            'name'=>'North tagamo3 point',
            'address'=>'north 90 street',
            'contactno'=>'0220344489',
            'email' =>'north90@email.com',
            'password'=>Hash::make('1234567'),
         ],[
            'name'=>'South tagamo3 point',
            'address'=>'South 90 street',
            'contactno'=>'0220344489',
            'email' =>'north90@email.com',
            'password'=>Hash::make('1234567'),
         ],

        ];
        foreach ($ambulances as $a){
            Doctor::firstOrCreate($ambulance);
        }
    }
}
