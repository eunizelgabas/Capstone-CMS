<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'specialization', 'contact_no'];

    public function service()
    {
        return $this->hasOne(Service::class, 'doc_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
