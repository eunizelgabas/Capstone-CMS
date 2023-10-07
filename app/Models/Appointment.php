<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public $fillable = ['name', 'date', 'time', 'doctor_id', 'service_id', 'reason'];

    // public function user(){
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id');
    }
}
