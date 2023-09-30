<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function medicine()
    {
        return $this->hasMany(Medicine::class, 'med_id');
    }
}
