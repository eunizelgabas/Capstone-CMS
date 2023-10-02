<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'specialization', 'status'];

    public function service()
    {
        return $this->hasMany(Service::class, 'doc_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
