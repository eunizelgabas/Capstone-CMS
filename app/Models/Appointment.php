<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_date',
        'appointment_time',
        // 'service_id',
        'status',
        // 'patient_id',
    ];

    // public function service(){

    //     return $this->belongsTo('App\Models\Service');
    // }

    // public function patient(){

    //     return $this->belongsTo('App\Models\Patient');
    // }
}
