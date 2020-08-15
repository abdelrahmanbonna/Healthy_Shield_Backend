<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'date'=>$this->date,
            'doctor_name'=>$this->doctors->name,
            'doctor_email'=>$this->doctors->email,
            'doctor_phone'=>$this->doctors->phone,
            'doctor_specialization'=>$this->doctors->doctorspecializations->specialization,
            'medicalplaces_name'=>$this->medicalplaces->name,
            'medicalplaces_email'=>$this->medicalplaces->email,
            'medicalplaces_phone'=>$this->medicalplaces->phone,
            'medicalplaces_address'=>$this->medicalplaces->address,

        ];
    }
}
