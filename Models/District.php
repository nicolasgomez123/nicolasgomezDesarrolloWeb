<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    //Asignacion masiva de campos
    protected $fillable = ['name', 'city_id'];


    //relacion entre modelos

    //ralacion de uno a muchos entre distritos y ordenes 
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
