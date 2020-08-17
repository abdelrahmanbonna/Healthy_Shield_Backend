<?php

use Illuminate\Database\Seeder;
use App\DoctorSpecialization;

class SpecalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specalizations=[
            ['specialization'=>'Heart'],
            ['specialization'=>'Dental'],
            ['specialization'=>'Obstetrician'],
            ['specialization'=>'Pediatrician'],
            ['specialization'=>'Surgeon'],
            ['specialization'=>'Psychiatrist'],
            ['specialization'=>'Cardiologist'],
            ['specialization'=>'Dermatologist'],
            ['specialization'=>'Endocrinologist'],
            ['specialization'=>'Gastroenterologist'],
            ['specialization'=>'Nephrologist'],
            ['specialization'=>'Pediatricians'],
            ['specialization'=>'Dermatologists'],
            ['specialization'=>'Cardiologists'],
        ];
    }
}
