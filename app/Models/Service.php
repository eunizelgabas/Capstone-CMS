<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['doc_id', 'name' , 'description'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doc_id');
    }

    public function user(){
        return $this->hasOneThrough(User::class, Doctor::class, 'id', 'id', 'doc_id', 'user_id');
    }
}
