<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['med_id', 'purchase_date' , 'qty', 'expiry_date'];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'med_id');
    }

    // public function stocks(){
    //     return $this->hasMany(Inventory::class);
    // }
}
