<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

//Asignacion masiva de campos
protected $fillable = ['name', 'cost', 'department_id'];



//relaciones entre modelos

    //ralacion de uno a muchos entre departamentos y ciudades 
    public function districts(){
        return $this->hasMany(District::class);
    }

    //ralacion de uno a muchos entre ciudades y ordenes 
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
