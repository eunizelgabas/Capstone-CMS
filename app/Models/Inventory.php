<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['med_id', 'stock_out', 'stock_in'];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'med_id');
    }

    public function getAvailableAttribute(){
        
        return $this->stock_out ? ($this->stock_in - $this->stock_out) : $this->stock_in;
        
    }

}
