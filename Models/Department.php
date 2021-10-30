<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    //asignacion masiva
    protected $fillable = ['name'];


    //relaciones entre modelos

    //ralacion de uno a muchos entre departamentos y ciudades 
    public function cities(){
        return $this->hasMany(City::class);
    }

    //ralacion de uno a muchos entre departamentos y ordenes 
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
