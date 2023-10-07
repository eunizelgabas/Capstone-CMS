<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'name' , 'description'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function user(){
        return $this->hasOneThrough(User::class, Doctor::class, 'id', 'id', 'doctor_id', 'user_id');
    }
}
