<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'date', 'time', 'doc_id', 'service_id', 'reason'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doc_id');
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
