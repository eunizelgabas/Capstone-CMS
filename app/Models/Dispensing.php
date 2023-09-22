<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispensing extends Model
{
    use HasFactory;

    protected $fillable = ['med_id', 'name', 'qty'];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'med_id');
    }
}
