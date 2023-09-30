<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['med_id', 'user_id', 'qty'];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'med_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
