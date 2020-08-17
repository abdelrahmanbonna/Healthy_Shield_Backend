<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins=[
                   ['username'=>'bonna','password'=>Hash::make('1234abdo')],
                   ['username'=>'admin','password'=>Hash::make('1234admin')],
                   ['username'=>'Hero','password'=>Hash::make('1234Hero')],
        ];

        foreach ($admins as $admin){
            Doctor::firstOrCreate($admin);
        }
    }
}
